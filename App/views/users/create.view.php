<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>


<div class="flex min-h-full flex-col justify-center px-6 py-16 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
      Create an account
    </h2>

  </div>

 <?= loadPartial('create-user', [
  'showSignIn' => true,
 ]) ?>
</div>

<?= loadPartial('footer') ?>