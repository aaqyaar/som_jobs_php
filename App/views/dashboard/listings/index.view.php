<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
 
<?= loadPartial('sidebar') ?>

<div class="fixed ml-44 overflow-auto h-screen left-0 right-0 z-[100]">

<div class="max-w-[1160px] p-3 mx-auto mt-4 overflow-auto">
<div class="flex items-end justify-end gap-2">

<a href="/dashboard/listings/create" class="mb-6 rounded-md bg-slate-800 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">
       <i class="fa fa-edit"></i>  Post a Job
      </a>
</div>
<div class="relative shadow rounded-lg overflow-auto">
    <table class="w-full text-sm text-left rtl:text-right text-slate-500">
        <thead class="py-4 bg-slate-50 border-b border-slate-200 text-xs text-slate-700 uppercase ">
            <tr class="py-4">
                <th scope="col" class="px-6 py-4">
                    Job Title
                </th>
                <th scope="col" class="px-6 py-4">
                    Description
                </th>
                <th scope="col" class="px-6 py-4">
                    Company  
                </th>
                <th scope="col" class="px-6 py-4">
                    Email
                </th>
                <th scope="col" class="px-6 py-4">
                    Phone
                </th>
                <th scope="col" class="px-6 py-4">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>

          <?php foreach($listings as $listing): ?>
            <tr class="bg-white  border-b border-slate-100">
                <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                    <?= $listing->title ?>
                </th>
                <td class="px-6 py-4">
                     <?= $listing->description ?>
                </td>
                <td class="px-6 py-4">
                     <?= $listing->company ?>
                </td>
                <td class="px-6 py-4">
                     <?= $listing->email ?>
                </td>
                 <td class="px-6 py-4">
                     <?= $listing->phone ?>
                </td>
                <td class="px-6 py-4 flex gap-3">
                    <a href="/dashboard/listings/edit/<?= $listing->id ?>" class="font-medium text-slate-700 hover:underline">Edit</a>
                 
               <form method="POST" action="/dashboard/listings/<?= $listing->id ?>">
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
 