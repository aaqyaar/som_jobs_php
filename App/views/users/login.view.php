<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>


<div class="flex min-h-full flex-col justify-center px-6 py-16 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>

  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
 <?= loadPartial('errors', [
      'errors' => $errors ?? []
    ]) ?>
    <form class="space-y-6" action="/auth/login" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" autocomplete="email" required class="textfield">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="text-sm">
            <a href="#" class="font-semibold text-slate-600 hover:text-slate-500">Forgot password?</a>
          </div>
        </div>
        <div class="mt-2">
          <input id="password" name="password" type="password" autocomplete="current-password" required class="textfield">
        </div>
      </div>

      <div>
        <button type="submit" class="btn-contained">Sign in</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      Not a member?
      <a href="/auth/register" class="font-semibold leading-6 text-slate-600 hover:text-slate-500">
        Sign up now
      </a>
    </p>
  </div>
</div>


<?= loadPartial('footer') ?>