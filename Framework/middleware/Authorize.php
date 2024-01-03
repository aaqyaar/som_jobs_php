<?php

namespace Framework\Middleware;

use Framework\Session;
// use Framework\Authorization;

class Authorize
{
  /**
   * Check if user is authenticated
   * 
   * @return bool
   */
  public function isAuthenticated()
  {
    return Session::has('user');
  }

  /**
   * Handle the user's request
   * 
   * @param string $role
   * @return bool
   */
  public function handle($role)
  {
    $user = isset(Session::get('user')['role']) ? Session::get('user')['role'] : null;

   

    if ($role === 'guest' && $this->isAuthenticated()) {
      return redirect('/');
    } elseif ($role === 'auth' && !$this->isAuthenticated()) {
      return redirect('/auth/login');
    } elseif ($role === 'admin' && $user !== 'admin') {
      return redirect('/');
    }  
  }
}
