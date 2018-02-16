@extends('layout')

@section('title', 'VapeStoreMaps')

@section('content')
    <div class="contains">
        @include('store.listings')
        {{ $store->links() }}
    </div>
@stop

@section('scripts.footer')
@stop