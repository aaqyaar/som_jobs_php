<!-- Showcase -->
<section class="bg-slate-100 py-20 relative flex items-center">
  <div class="container mx-auto text-center z-10">
    <h2 class="text-4xl text-slate-950 font-bold mb-4">Find Your Dream Job</h2>
    <p class="text-xl text-slate-900 mb-4">
      Somjobs, You can find your dream job here.
    </p>
    <form method="GET" action="/listings/search" class="mb-4 block mx-5 md:mx-auto space-x-3">
      <input type="text" name="keywords" placeholder="Keywords" class="inline py-2.5 w-full md:w-[20rem] textfield" />
 <input type="text" name="location" placeholder="Location" class="inline py-2.5 w-full md:w-[20rem] textfield" />
      <button class="md:w-auto w-full rounded-md bg-slate-800 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">
        <i class="fa fa-search"></i> Search
      </button>
    </form>
  </div>
</section>