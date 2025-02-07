<x-layout>
    <x-slot:heading>Create job</x-slot:heading>

<form action="/jobs" method="post">
    @csrf
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-base/7 font-semibold text-gray-900">Details</h2>
      <p class="mt-1 text-sm/6 text-gray-600">Please enter your details.</p>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
        <x-form-label for="title">Title</x-form-label>     
          <div class="mt-2">
            <x-form-input  name="title" id="title" placeholder="Mr." required/>
           <x-form-error name="title"/>
            
           <x-form-label for="username">Username</x-form-label>     
          <div class="mt-2">
            <x-form-input  name="username" id="username" placeholder="janes" required />
           <x-form-error name='username'/>
          </div>
        </div>
</div>
        
  <div class="mt-6 flex items-center justify-end gap-x-6">
   <a href="/jobs"> <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button></a>
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
  </div>
</form>
</x-layout>