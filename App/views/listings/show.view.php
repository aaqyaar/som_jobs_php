<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('top-banner') ?>

<section class="container mx-auto p-4 mt-4">
  <div class="rounded-lg shadow-md bg-white p-3">
    <?= loadPartial('message') ?>
    <div class="flex justify-between items-center">
      <a class="block p-4 text-slate-700" href="/listings">
        <i class="fa fa-arrow-alt-circle-left"></i>
        Back To Listings
      </a>
      <?php
        use Framework\Session;
        use Framework\Authorization;

        $user = isset(Session::get('user')['role']) ? Session::get('user')['role'] : null;

      if ($user === "admin" || Authorization::isOwner($listing->user_id)) : ?>
        <div class="flex space-x-4 ml-4">
          <a href="/dashboard/listings/edit/<?= $listing->id ?>" class="px-4 py-2 bg-slate-500 hover:bg-slate-600 text-white rounded">Edit</a>
        </div>
      <?php endif; ?>
    </div>
    <div class="p-4">
      <h2 class="text-xl font-semibold"><?= $listing->title ?></h2>
      <p class="text-gray-700 text-lg mt-2">
        <?= $listing->description ?>
      </p>
      <ul class="my-4 bg-gray-100 p-4">
        <li class="mb-2"><strong>Salary:</strong> <?= formatSalary($listing->salary) ?></li>
        <li class="mb-2">
          <strong>Location:</strong> <?= $listing->city ?>, <?= $listing->state ?>
          <!-- <span class="text-xs bg-slate-500 text-white rounded-full px-2 py-1 ml-2">Local</span> -->
        </li>
        <?php if (!empty($listing->tags)) : ?>
          <li class="mb-2">
            <strong>Tags:</strong> <?= $listing->tags ?>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</section>

<section class="container mx-auto p-4">
  <h2 class="text-xl font-semibold mb-4">Job Details</h2>
  <div class="rounded-lg shadow-md bg-white p-4">
    <h3 class="text-lg font-semibold mb-2 text-slate-900">
      Job Requirements
    </h3>
    <p>
      <?= $listing->requirements ?>
    </p>
    <h3 class="text-lg font-semibold mt-4 mb-2 text-slate-900">Benefits</h3>
    <p><?= $listing->benefits ?></p>
  </div>

  
  <?php use Framework\Middleware\Authorize; if ($listing->expireDate > date('Y-m-d')) : ?>
      <p class="my-5">
    Put "Job Application" as the subject of your email and attach your
    resume.
  </p>

 <?php 
 
 $authorize = new Authorize();
 if ($authorize->isAuthenticated()) : ?>

<a href="mailto:<?= $listing->email ?>" class="block text-center w-full rounded-md bg-slate-800 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">
    Apply Now
  </a>

  <?php else:?>
    '<a href="/auth/login" class="block text-center w-full rounded-md bg-slate-800 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">
    To Apply, Login
  </a>
  

 <?php endif; ?>

  <?php else: ?>
    <p class="my-5 text-red-500 font-semibold">
    This job has expired.

  <?php endif; ?>


</section>

<?= loadPartial('footer') ?>