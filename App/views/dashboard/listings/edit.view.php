<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
 
<section class="mb-12 max-w-screen-md mx-auto flex justify-center items-center mt-20">
  <div class="w-full md:w-600 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Edit Job Listing</h2>
    <form method="POST" action="/dashboard/listings/<?= $listing->id ?>">
      <input type="hidden" name="_method" value="PUT">
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Job Info
      </h2>
      <?= loadPartial('errors', [
        'errors' => $errors ?? []
      ]) ?>
      <div class="mb-4">
        <input type="text" name="title" placeholder="Job Title" class="textfield" value="<?= $listing->title ?? '' ?>" />
      </div>
      <div class="mb-4">
        <textarea name="description" placeholder="Job Description" class="textfield"><?= $listing->description ?? '' ?></textarea>
      </div>
      <div class="mb-4">
        <input type="text" name="salary" placeholder="Annual Salary" class="textfield" value="<?= $listing->salary ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="requirements" placeholder="Requirements" class="textfield" value="<?= $listing->requirements ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="benefits" placeholder="Benefits" class="textfield" value="<?= $listing->benefits ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="tags" placeholder="Tags" class="textfield" value="<?= $listing->tags ?? '' ?>" />
      </div>
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Company Info & Location
      </h2>
      <div class="mb-4">
        <input type="text" name="company" placeholder="Company Name" class="textfield" value="<?= $listing->company ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="address" placeholder="Address" class="textfield" value="<?= $listing->address ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="city" placeholder="City" class="textfield" value="<?= $listing->city ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="state" placeholder="State" class="textfield" value="<?= $listing->state ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="phone" placeholder="Phone" class="textfield" value="<?= $listing->phone ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="email" name="email" placeholder="Email Address For Applications" class="textfield" value="<?= $listing->email ?? '' ?>" />
      </div>
      <button class="w-full bg-slate-800 hover:bg-slate-900 text-white px-4 py-3 my-3 rounded focus:outline-none">
        Save
      </button>
      <a href="/listings/<?= $listing->id ?>" class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
        Cancel
      </a>
    </form>
  </div>
</section>

<?= loadPartial('footer') ?>