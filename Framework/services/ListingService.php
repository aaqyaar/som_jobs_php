<?php

namespace Framework\Services;

use App\Controllers\ErrorController;
use Framework\Authorization;
use Framework\Session;
use Framework\Validation;

class ListingService {
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    
    /**
     * Store listings in the database
     * 
     * @return void
     */
    public function storeListing() {
    $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];

    $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

    $newListingData['user_id'] = Session::get('user')['id'];

    $newListingData = array_map('sanitize', $newListingData);

    $requiredFields = ['title', 'description', 'salary', 'email', 'city', 'state'];

    $errors = [];

    foreach ($requiredFields as $field) {
      if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
        $errors[$field] = ucfirst($field) . ' is required';
      }
    }

    if (!empty($errors)) {
      // Reload view with errors
      loadView('dashboard/listings/create', [
        'errors' => $errors,
        'listing' => $newListingData
      ]);
    } else {
      // Submit data
      $fields = [];

      foreach ($newListingData as $field => $value) {
        $fields[] = $field;
      }

      $fields = implode(', ', $fields);

      $values = [];

      foreach ($newListingData as $field => $value) {
        // Convert empty strings to null
        if ($value === '') {
          $newListingData[$field] = null;
        }
        $values[] = ':' . $field;
      }

      $values = implode(', ', $values);

      $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";

      $this->db->query($query, $newListingData);

      Session::setFlashMessage('success_message', 'Listing created successfully');

      redirect('/dashboard/listings');
    }
  }

  /**
   * Delete a listing
   * 
   * @param array $params
   * @return void
   */
  public function destroy($params)
  {
    $id = $params['id'];

    $params = [
      'id' => $id
    ];

    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

    // Check if listing exists
    if (!$listing) {
      ErrorController::notFound('Listing not found');
      return;
    }

    // Authorization
    if (Session::get('user')['role'] !== "admin" &&  !Authorization::isOwner($listing->user_id)) {
      Session::setFlashMessage('error_message', 'You are not authoirzed to delete this listing');
      return redirect('/listings/' . $listing->id);
    }

    $this->db->query('DELETE FROM listings WHERE id = :id', $params);

    // Set flash message
    Session::setFlashMessage('success_message', 'Listing deleted successfully');

    redirect('/dashboard/listings');
  }

    public function editUser($params) {
        $id = $params['id'] ?? '';

        $params = [
        'id' => $id
        ];

        $user = $this->db->query('SELECT * FROM users WHERE id = :id', $params)->fetch();

        // Check if user exists
        if (!$user) {
        ErrorController::notFound('User not found');
        return;
        }

        // Authorization
        if (Session::get('user')['role'] !== "admin" && !Authorization::isOwner($user->user_id)) {
        Session::setFlashMessage('error_message', 'You are not authoirzed to update this user');
        return redirect('/dashboard/users/' . $user->id);
        }

        loadView('dashboard/users/edit', [
        'user' => $user
        ]);
    }

    /**
   * Update a listing
   * 
   * @param array $params
   * @return void
   */
  public function updateListing($params)
  {
    $id = $params['id'] ?? '';

    $params = [
      'id' => $id
    ];

    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

    // Check if listing exists
    if (!$listing) {
      ErrorController::notFound('Listing not found');
      return;
    }

    // Authorization
    if (Session::get('user')['role'] !== "admin" && !Authorization::isOwner($listing->user_id)) {
      Session::setFlashMessage('error_message', 'You are not authoirzed to update this listing');
      return redirect('/listings/' . $listing->id);
    }

    $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];

    $updateValues = [];

    $updateValues = array_intersect_key($_POST, array_flip($allowedFields));

    $updateValues = array_map('sanitize', $updateValues);

    $requiredFields = ['title', 'description', 'salary', 'email', 'city', 'state'];

    $errors = [];

    foreach ($requiredFields as $field) {
      if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
        $errors[$field] = ucfirst($field) . ' is required';
      }
    }

    if (!empty($errors)) {
      loadView('dashboard/listings/edit', [
        'listing' => $listing,
        'errors' => $errors
      ]);
      exit;
    } else {
      // Submit to database
      $updateFields = [];

      foreach (array_keys($updateValues) as $field) {
        $updateFields[] = "{$field} = :{$field}";
      }

      $updateFields = implode(', ', $updateFields);

      $updateQuery = "UPDATE listings SET $updateFields WHERE id = :id";

      $updateValues['id'] = $id;
      $this->db->query($updateQuery, $updateValues);

      // Set flash message
      Session::setFlashMessage('success_message', 'Listing updated');

      redirect('/dashboard/listings/');
    }
  }
}