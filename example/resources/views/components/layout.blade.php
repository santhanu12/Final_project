<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
    <head>
        <title>
            Home</title>
            @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
<body class="h-full">
        <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">     
  ```
-->
<div class="min-h-full" style="margin-bottom:0px; padding-bottom:0px">
  <nav class="bg-gray-800" style="margin-bottom:0px; padding-bottom:0px">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0">
            <img class="size-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <x-nav href="/" :active="request()->is('/')">Home</x-nav>
              <x-nav href="/about" :active="request()->is('about')">About</x-nav>
              <x-nav href="/contact" :active="request()->is('contact')" type="a">Contact</x-nav>
              <x-nav href="/jobs" :active="request()->is('jobs')" type="a">Jobs</x-nav>
              <x-nav href="/jobs/create" :active="request()->is('create')" type="a">Create Jobs</x-nav>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            @guest
           <x-nav href="/login">Login</x-nav>
           <x-nav href="/register">Register</x-nav> 
              @endguest
              @auth
              <form method='post' action='/logout'>
              @csrf
              <button type='submit'>Logout</button>
              </form>
              @endauth

            </div>
          </div>
        </div>

        
      </div>
     </nav>
    


  <header class="bg-white shadow" style="margin-top:0px ;padding-top:0px">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8" style="margin-top:0px ;padding-top:0px">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{$heading}}</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
      {{ $slot }}
    </div>
  </main>
</div>
       
    </body>
</html>