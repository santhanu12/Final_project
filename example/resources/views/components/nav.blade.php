@props(['active'=>false, 'type'=>'a'])

@if($type=='a')
<a {{$attributes}} class="{{ $active ?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white'}} block rounded-md px-3 py-2 text-base font-medium">{{$slot}}</a>
@else($type=='button')
<button {{$attributes}} class="{{ $active ?'bg-gray-900 text-white':'text-gray-300 hover:bg-gray-700 hover:text-white'}} block rounded-md px-3 py-2 text-base font-medium">{{$slot}}</button>
@endif