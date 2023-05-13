<h1>{{$heading}}</h1>


{{-- @if(count($listings) == 0)
    <p>No listings found</p>

@endif --}}

@unless(count($listings) == 0) 

    @foreach($listings as $listing)
        <h2>
            {{$listing['title']}}
        </h2>
        <p>
            {{$listing['description']}}
        </p>

    @endforeach

@else 
    <p>No listings found</p>

@endunless