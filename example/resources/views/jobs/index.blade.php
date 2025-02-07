<x-layout>
<x-slot:heading>jobs</x-slot:heading>
    <p>This is job page.</p>
    @foreach ($jobs as $job)
    Employer:{{$job->Employer->name}}<br>
    <li><a href="/job/{{{$job['id']}}}">Title:{{$job['title']}},  
    Name:{{$job['name']}}</a></li>
 @endforeach   
    <div>
        {{$jobs->links()}}
</div>
</x-layout>