<?php if (isset($errors)) : ?>
  <?php foreach ($errors as $error) : ?>
    <div class="message py-2 rounded-md px-2 bg-red-100 my-3"><?= $error ?></div>
  <?php endforeach; ?>
<?php endif; ?>