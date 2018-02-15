
@extends('layout')

@section('content')
    <div class="contains">
        <h1>Add Spa</h1>
        <div class="row">
            <form method="post" action="/store" enctype="multipart/form-data" class="col-md-6 create-form">
                @include('store.form')
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
@stop