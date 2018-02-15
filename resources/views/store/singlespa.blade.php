@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1>{!! $store->store_name !!}</h1>
            <hr>
            <h3>{!! $store->store_address !!}</h3>
            <p>{!! $store->store_phone !!}</p>
            <p>{!! $store->store_hours !!}</p>
            <div class="description">{!! nl2br($store->store_description) !!} </div>

        </div>
    </div>
    <h2>name and address</h2>
@stop

@section('scripts.footer')

@stop