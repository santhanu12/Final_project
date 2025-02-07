@props(['name'])

@error($name)
            <p class="text-red">{{$message}}</p>
@enderror