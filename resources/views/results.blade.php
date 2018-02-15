@extends('layout')

@section('title', 'Results for '.$storename)

@section('content')
    <div class="contains">

        @if($store->count() > 0)
            @include('store.listings')
        @else
            <div class="spa-container">
                <h2>Sorry, no results for {{ $storename }}</h2>
            </div>
        @endif
    </div>
@stop