@extends('layout')

@section('title', 'SpaPal')

@section('content')
    <div class="contains">
        @include('store.listings')
        {{ $store->links() }}
    </div>
@stop

@section('scripts.footer')
@stop