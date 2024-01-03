<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
 
<?= loadPartial('sidebar') ?>

<div class="fixed ml-44 left-0 right-0 z-[100]">



<div class="max-w-[1160px] p-3 mx-auto mt-4 overflow-x-auto">
<div class="my-3">
        <?= loadPartial('message') ?>

</div>
<div class="flex items-end justify-end gap-2">

<a href="/dashboard/users/create" class="mb-6 rounded-md bg-slate-800 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">
       <i class="fa fa-edit"></i>  Create user
      </a>
</div>

<div class="relative shadow rounded-lg overflow-auto">
    <table class="w-full text-sm text-left rtl:text-right text-slate-500">
        <thead class="py-4 bg-slate-50 border-b border-slate-200 text-xs text-slate-700 uppercase ">
            <tr class="py-4">
                <th scope="col" class="px-6 py-4">
                    Name
                </th>
                <th scope="col" class="px-6 py-4">
                    Email
                </th>
                <th scope="col" class="px-6 py-4">
                    City  
                </th>
                <th scope="col" class="px-6 py-4">
                    State
                </th>
                <th scope="col" class="px-6 py-4">
                    Role
                </th>
                <th scope="col" class="px-6 py-4">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>

          <?php foreach($users as $user): ?>
            <tr class="bg-white  border-b border-slate-100">
                <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                    <?= $user->name ?>
                </th>
                <td class="px-6 py-4">
                     <?= $user->email ?>
                </td>
                <td class="px-6 py-4">
                     <?= $user->city ?>
                </td>
                <td class="px-6 py-4">
                     <?= $user->state ?>
                </td>
                 <td class="px-6 py-4">
                     <?= $user->role ?>
                </td>
                <td class="px-6 py-4 flex gap-3">
                    <a href="/dashboard/users/edit/<?= $user->id ?>" class="font-medium text-slate-700 hover:underline">Edit</a>
                 
            <form method="POST" action="/dashboard/users/<?= $user->id ?>">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="font-medium text-red-600 ml-3 hover:underline">Delete</button>
          </form>
                </td>
            </tr>
            <?php endforeach; ?>
          
        </tbody>
    </table>
</div>
</div>



</div>
 