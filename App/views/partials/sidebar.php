<div id="docs-sidebar" class="fixed top-0 start-0 bottom-0 -z-[2] w-64 border-e pt-7 pb-10 overflow-y-auto lg:end-auto lg:bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full  [&::-webkit-scrollbar-thumb]:bg-gray-300 [&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500 bg-slate-50 border-slate-100">
   
  <nav class="mt-12 hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
    <ul class="space-y-1.5">
        <div class="space-x-2">

            <a href="/dashboard" class="cursor-pointer <?= $_SERVER['REQUEST_URI'] === '/dashboard' ? 'btn-contained' : 'btn-text' ?> mt-4 flex justify-start items-center gap-2"><i class="fa fa-home"></i> Dashboard</a>
          </div>

          <div class="space-x-2"> 
            <a href="/dashboard/users" class="cursor-pointer <?= str_contains( $_SERVER['REQUEST_URI'], 'users') ? 'btn-contained mt-4 flex justify-start items-center gap-2' : 'btn-text' ?>"><i class="fa fa-users"></i> Users</a>
          </div>

          <div class="space-x-2"> <a href="/dashboard/listings" class="cursor-pointer <?= str_contains( $_SERVER['REQUEST_URI'], 'listings') ? 'btn-contained mt-4 flex justify-start items-center gap-2' : 'btn-text' ?>"><i class="fa fa-list"></i> Job Listings</a>
          </div>
 
    </ul>
  </nav>
</div>

