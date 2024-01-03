<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>



<section class="mb-12 max-w-screen-md mx-auto flex justify-center items-center mt-12">
  <div class="w-full md:w-600 mx-6">
    <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
      Register new user
    </h2>
     <?= loadPartial('message') ?>

  <?= loadPartial('create-user', [
  'showSignIn' => false,
  'errors' => $errors ?? [],
  'action' => '/dashboard/users/create',
  ]) ?>

</div>

</section>
<?= loadPartial('footer') ?>