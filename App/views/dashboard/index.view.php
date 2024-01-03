<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
 
<?= loadPartial('sidebar') ?>


<div class="fixed ml-44 left-0 right-0 z-[100]">
<div class="max-w-[1160px] p-3 mx-auto mt-4 overflow-x-auto">

<?php

use Framework\Session;


$currentUser = array(
    'name' => Session::get('user')['name'],
    'email' => Session::get('user')['email'],
    'avatar' => 'https://github.com/aaqyaar.png',
    'role' => Session::get('user')['role'],
    'joined' => Session::get('user')['created_at'],
    'city' => Session::get('user')['city'],
    'state' => Session::get('user')['state']
);
?>

<div class="bg-white rounded-lg shadow-sm p-4 mb-8">
    <h2 class="text-xl font-semibold mb-4 text-slate-900">
        Current User Profile
    </h2>
    <div class="flex items-center">
        <img src="<?php echo $currentUser['avatar']; ?>" alt="User Avatar" class="w-14 h-14 rounded-full mr-4">
        <div>
            <h3 class="text-lg font-semibold"><?php echo $currentUser['name']; ?></h3>
            <p class="text-gray-600"><?php echo $currentUser['email']; ?></p>
        </div>
    </div>

    <div class="mt-4">
        <p class="text-gray-600">Role: <span class="uppercase font-semibold">
            <?php echo $currentUser['role']; ?>
        </span></p>
        <p class="text-gray-600">City: <?php echo $currentUser['city']; ?></p>
    </div>
    
    
    <div class="mt-4">
        <p class="text-gray-600">State: <span class="font-semibold">
            <?php echo $currentUser['state']; ?>
        </span></p>
        <p class="text-gray-600">Joined: <?php echo date('F d, Y', strtotime($currentUser['joined'])); ?></p>
    </div>
</div>


<h2 class="text-xl font-bold mb-4 text-slate-900">
    Dashboard
</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

      <div class="rounded-lg shadow-sm bg-white p-6">
        <div class="flex items-center justify-between">
          <h3 class="text-xl font-bold text-slate-800">Total Users</h3>
          <i class="fas fa-users text-slate-800 w-8 h-8"></i>
        </div>
        <div class="text-3xl font-semibold my-2">
            <?= $countUsers ?>
        </div>
        <div class="text-sm text-gray-500">+5.2% from last week</div>
      </div>


      <div class="rounded-lg shadow-sm bg-white p-6">
        <div class="flex items-center justify-between">
          <h3 class="text-xl font-bold text-slate-800">Total Listings</h3>
          <i class="fas fa-list text-slate-800 w-8 h-8"></i>
        </div>
        <div class="text-3xl font-semibold my-2">
            <?= $countListings ?>
        </div>
        <div class="text-sm text-gray-500">+5.2% from last week</div>
      </div>
      </div>

      
  </div>
</div>
</body>
</html>