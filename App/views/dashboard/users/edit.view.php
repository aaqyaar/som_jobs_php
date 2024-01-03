<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>



<section class="mb-12 max-w-screen-md mx-auto flex justify-center items-center mt-12">
  <div class="w-full md:w-600 mx-6">
    <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
       Update user
    </h2>

     <?= loadPartial('message') ?>

  <?= loadPartial('edit-user', [
  'user' => $user,
  'errors' => $errors ?? [],
  ]) ?>

</div>

</section>
<?= loadPartial('footer') ?>