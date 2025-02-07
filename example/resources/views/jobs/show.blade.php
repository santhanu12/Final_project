<x-layout>
<x-slot:heading>jobs</x-slot:heading>
    <p>This is job page.</p>
    
    Title:{{$job['title']}}<br>
    Name:{{$job['name']}}<br>
    @can('edit',$job)
    <a href="../jobs/{{$job['id']}}/edit"> <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</button></a>
    <a href="/jobs/delete"> <button form="delete-form" type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Delete</button></a>
    @endcan
    <form action="/job/{{$job->id}}" method="post" class="hidden" id="delete-form">
        @csrf
        @method('DELETE')
</x-layout>
