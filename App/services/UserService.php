<?php

namespace App\Services;

use App\Controllers\ErrorController;
use Framework\Authorization;
use Framework\Session;
use Framework\Validation;

 class UserService {

    protected $db;

  public function __construct($db)
  {
    $this->db = $db;
  }
    public function storeUser()
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['password_confirmation'];

    $errors = [];

    // Validation
    if (!Validation::email($email)) {
      $errors['email'] = 'Please enter a valid email address';
    }

    if (!Validation::string($name, 2, 50)) {
      $errors['name'] = 'Name must be between 2 and 50 characters';
    }

    if (!Validation::string($password, 6, 50)) {
      $errors['password'] = 'Password must be at least 6 characters';
    }

    if (!Validation::match($password, $passwordConfirmation)) {
      $errors['password_confirmation'] = 'Passwords do not match';
    }

    if (!empty($errors)) {
      loadView('dashboard/users/create', [
        'errors' => $errors,
        'user' => [
          'name' => $name,
          'email' => $email,
          'city' => $city,
          'state' => $state,
        ]
      ]);
      exit;
    }

    // Check if email exists
    $params = [
      'email' => $email
    ];

    $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

    if ($user) {
      $errors['email'] = 'That email already exists';
      loadView('dashboard/users/create', [
        'errors' => $errors
      ]);
      exit;
    }

    // Create user account
    $params = [
      'name' => $name,
      'email' => $email,
      'city' => $city,
      'state' => $state,
      'password' => password_hash($password, PASSWORD_DEFAULT),
    ];

    $this->db->query('INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)', $params);

    Session::setFlashMessage('success_message', 'Account created successfully');
    redirect('/dashboard/users');
  }


  

  /**
   * Update a listing
   * 
   * @param array $params
   * @return void
   */
  public function updateUser($params)
  {
  $id = $params['id'] ?? '';
  $params = ['id' => $id];

  // Check if user exists
  $user = $this->db->query('SELECT * FROM users WHERE id = :id', $params)->fetch();
  if (!$user) {
    ErrorController::notFound('User not found');
    return;
  }

  $allowedFields = ['name', 'email', 'city', 'state', 'password'];
  $updateValues = array_intersect_key($_POST, array_flip($allowedFields));
  $updateValues = array_map('sanitize', $updateValues);

  $requiredFields = ['name', 'email', 'city', 'state'];
  $errors = [];

  foreach ($requiredFields as $field) {
    if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
        $errors[$field] = ucfirst($field) . ' is required';
    }
  }

  if (!empty($errors)) {
    loadView('dashboard/users/edit', [
        'user' => $user,
        'errors' => $errors
    ]);
    exit;
  }

  // Prepare update query
  $updateFields = [];
  foreach (array_keys($updateValues) as $field) {
    $updateFields[] = "{$field} = :{$field}";
  }

  if (!empty($updateValues['password'])) {
    $updateValues['password'] = password_hash($updateValues['password'], PASSWORD_DEFAULT);
  }

  $updateFieldsStr = implode(', ', $updateFields);
  $updateQuery = "UPDATE users SET {$updateFieldsStr} WHERE id = :id";
  $updateValues['id'] = $id;

  $this->db->query($updateQuery, $updateValues);
  redirect('/dashboard/users/');
  }



   /**
   * Delete a user
   * 
   * @param array $params
   * @return void
   */
  public function destroyUser($params)
  {
    $id = $params['id'];

    $params = [
      'id' => $id
    ];

    // Check if user exists
    $user = $this->db->query('SELECT * FROM users WHERE id = :id', $params)->fetch();

    // Check if listing exists
    if (!$user) {
      ErrorController::notFound('User not found');
      return;
    }

    // Check if user has listings
    $listings = $this->db->query('SELECT * FROM listings WHERE user_id = :id', $params)->fetchAll();

    if (count($listings) > 0) {
      Session::setFlashMessage('error_message', 'You cannot delete a user with listings');
      return redirect('/dashboard/users/');
    }

    // Authorization
    if (Session::get('user')['role'] !== "admin" &&  !Authorization::isOwner($user->id)) {
      Session::setFlashMessage('error_message', 'You are not authoirzed to delete this user');
      return redirect('/dashboard/users/');
    }

    if ($user->role === "admin") {
      Session::setFlashMessage('error_message', 'You cannot delete an admin');
      return redirect('/dashboard/users/');
    }

    $this->db->query('UPDATE users SET status = "deleted" WHERE id = :id', $params);

    // Set flash message
    Session::setFlashMessage('success_message', 'User deleted successfully');

    redirect('/dashboard/users');
  }

 }