 <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">
 <?= loadPartial('errors', [
      'errors' => $errors ?? []
    ]) ?>

    <form method="POST" action="/dashboard/users/edit/<?= $user->id ?>" class="space-y-3">
          <input type="hidden" name="_method" value="PUT">

      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
        <div class="mt-2">
          <input type="text" name="name" placeholder="Full Name" required class="textfield" value="<?= $user->name ?? '' ?>" />
        </div>
      </div>

       <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" autocomplete="email" placeholder="Email Address" required class="textfield" value="<?= $user->email ?? '' ?>" />
        </div>
      </div>
      
      <div>
        <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
        <div class="mt-2">

        <input type="text" name="city" placeholder="City" required class="textfield" value="<?= $user->city ?? '' ?>" />
      </div>
      </div>
      <div>
        <label for="state" class="block text-sm font-medium leading-6 text-gray-900">State</label>
        <div class="mt-2">

        <input type="text" name="state" placeholder="State" required class="textfield" value="<?= $user->state ?? '' ?>" />
      </div>
      </div>

 
        <div class="">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        
          <div class="mt-2">
            <input id="password" placeholder="Password" name="password" type="password" autocomplete="current-password"  class="textfield">
          </div>
  
         
        </div>


      <div class="">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>

         <div class="mt-2">
          <input type="password" name="password_confirmation" placeholder="Confirm Password"  class="textfield">
        </div>
      </div>
 
      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-slate-800 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">Save</button>
      </div>
    </form>

    
  </div>