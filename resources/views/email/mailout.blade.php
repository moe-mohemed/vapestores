{{--
@extends('layout')

@section('title', 'Vape Stores in ' )
@section('content')
    <div class="contains">
        @foreach($stores as $store)
            @if($store->store_email != null)
                <p><a href="http://www.spapal.ca/{{ $store->region_slug.'/'.$store->city_slug.'/'.$store->store_name_slug }}" target="_blank">www.spapal.ca/{{ $store->region_slug.'/'.$store->city_slug.'/'.$store->store_name_slug }}</a></p>
                <p>{{ $store->store_email  }}</p>
            @endif
        @endforeach
    </div>
@stop

@section('scripts.footer')

@stop--}}
