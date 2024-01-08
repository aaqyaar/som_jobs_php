<?php


namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use Framework\Authorization;
use App\Services\ListingService;
use App\Services\UserService;


class DashboardController
{
  protected $db;
  protected $userService;

  protected $listingService;

  public function __construct()
  {
    $config = require basePath('config/db.php');
    $this->db = new Database($config);

    $this->userService = new UserService($this->db);
    $this->listingService = new ListingService($this->db);
  }

  /*
   * Render the dashboard
   * 
   * @return void
   */
  public function index()
  {
    $countListings = $this->getCountListings();
    $countUsers = $this->getCountUsers();

    loadView('dashboard/index', [
      'countListings' => $countListings,
      'countUsers' => $countUsers
    ]);


  }

  /*
   * Show the latest users
   * 
   * @return void
   */
  public function getUsers()
  {
    $users = $this->db->query('SELECT * FROM users WHERE status = "active" ORDER BY created_at DESC LIMIT 6')->fetchAll();

    loadView('dashboard/users/index', [
      'users' => $users
    ]);
  }

  /*
   * Show the latest listings
   * 
   * @return void
   */
  public function getListings()
  {
    $listings = $this->db->query('SELECT * FROM listings WHERE status = "active" ORDER BY created_at DESC LIMIT 6')->fetchAll();

    loadView('dashboard/listings/index', [
      'listings' => $listings
    ]);
  }

  /*
   * Show the count listings
   * 
   * @return void
   */
  public function getCountListings() {
    $listings = $this->db->query('SELECT * FROM listings WHERE status = "active"')->fetchAll();
    
    return count($listings);
  }

    /*
   * Show the count users
   * 
   * @return void
   */
  public function getCountUsers() {
    $users = $this->db->query('SELECT * FROM users WHERE status = "active"')->fetchAll();

    return count($users);
  }

   /**
   * Show the create listing form
   * 
   * @return void
   */
  public function createListing()
  {
    loadView('dashboard/listings/create');
  }

  /**
   * Show the create user form
   * 
   * @return void
   */
  public function createUser()
  {
    loadView('dashboard/users/create');
  }

  /**
   * Store data in database
   * 
   * @return void
   */
  public function storeListing()
  {
    $this->listingService->storeListing();
  }

  /**
   * Delete a listing
   * 
   * @param array $params
   * @return void
   */
  public function destroy($params)
  {
    $this->listingService->destroy($params);
  }

  /**
   * Show the listing edit form
   * 
   * @param array $params
   * @return void
   */
  public function editListing($params)
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

    loadView('dashboard/listings/edit', [
      'listing' => $listing
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
    $this->listingService->updateListing($params);
  }

  /**
   * store user data in database
   * @return void 
   */
  public function storeUser() {
    return $this->userService->storeUser();
  }


  /**
   * show edit user form
   * @param array $params
   * @return void
   */
  public function editUser($params)
  {
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
   * Update a user
   * 
   * @param array $params
   * @return void
   */
  public function updateUser($params) {
    return $this->userService->updateUser($params);
  }

  /**
   * Delete a user
   * 
   * @param array $params
   * @return void
   */
  public function destroyUser($params) {
    return $this->userService->destroyUser($params);
  }
}
