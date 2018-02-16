@extends('layout')

@section('title', 'Favorite Stores')

@section('content')
    <div class="contains">

        @if($store->count() > 0)
            @include('store.listings')
        @else
            <div class="spa-container">
                <h4>Looks like you don't have any favorite stores, click on the heart icon of stores you like to add them to your favorites.</h4>
            </div>
        @endif
    </div>
@stop