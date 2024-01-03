<?php

use Framework\Session;
?>

<header class="bg-slate-100 text-slate-950 p-4 z-50">
  <div class="max-w-screen-xl mx-auto flex justify-between items-center">
    <h1 class="text-3xl font-bold">
      <a href="/">Som Jobs</a>
    </h1>
    <nav class="space-x-4">
      <?php if (Session::has('user')) : ?>
        <div class="flex justify-between items-center gap-4">
         <?php if (Session::get('user')['role'] === 'admin') : ?>
          <div class="space-x-2"> <a href="/" class="btn-outlined"><i class="fa fa-home"></i> Home</a>
          </div>

            <div class="space-x-2"> <a href="/dashboard" class="btn-outlined"><i class="fa fa-dashboard"></i> Dashboard</a>
          </div>
          <?php endif; ?>
          <form method="POST" action="/auth/logout">
            <button type="submit" class="md:w-auto w-full rounded-md bg-red-500 px-3 py-1.5 text-sm font-semibold leading-6 shadow-sm hover:bg-red-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">Logout</button>
          </form>
        </div>
      <?php else : ?>
        <a href="/auth/login" class="btn-outlined">Login</a>
        <a href="/auth/register" class="btn-outlined">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>