
@extends('layout')

@section('content')
    <div class="contains">
        <h1>Edit Your Avatar</h1>
        <div class="row">
            {{--<form method="patch" action="{{ route('store.update', $store->id)}}" enctype="multipart/form-data" class="col-md-6 create-form">--}}
            {!! Form::model($user, ['method' => 'PATCH','route' => ['auth.update', $user->id], 'class'=> 'reg-form']) !!}
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="select-img" data-value="1.png">
                        <img src="/img/avatars/1.png" class="{{ $user->avatar == '1.png' ? 'selected-img' : '' }}">
                    </div>
                    <div class="select-img" data-value="2.png">
                        <img src="/img/avatars/2.png" class="{{ $user->avatar == '2.png' ? 'selected-img' : '' }}">
                    </div>
                    <div class="select-img" data-value="3.png">
                        <img src="/img/avatars/3.png" class="{{ $user->avatar == '3.png' ? 'selected-img' : '' }}">
                    </div>
                    <div class="select-img" data-value="4.png">
                        <img src="/img/avatars/4.png" class="{{ $user->avatar == '4.png' ? 'selected-img' : '' }}">
                    </div>
                    <div class="select-img" data-value="5.png">
                        <img src="/img/avatars/5.png" class="{{ $user->avatar == '5.png' ? 'selected-img' : '' }}">
                    </div>
                    <div class="select-img" data-value="6.png">
                        <img src="/img/avatars/6.png" class="{{ $user->avatar == '6.png' ? 'selected-img' : '' }}">
                    </div>
                    <div class="select-img" data-value="7.png">
                        <img src="/img/avatars/7.png" class="{{ $user->avatar == '7.png' ? 'selected-img' : '' }}">
                    </div>
                    <div class="select-img" data-value="8.png">
                        <img src="/img/avatars/8.png" class="{{ $user->avatar == '8.png' ? 'selected-img' : '' }}">
                    </div>
                    <div class="select-img" data-value="9.png">
                        <img src="/img/avatars/9.png" class="{{ $user->avatar == '9.png' ? 'selected-img' : '' }}">
                    </div>
                    <div class="select-img" data-value="10.png">
                        <img src="/img/avatars/10.png" class="{{ $user->avatar == '10.png' ? 'selected-img' : '' }}">
                    </div>
                    <input type="hidden" name="avatar" id="avatar" class="form-control avatar-value" value="{{ $user->avatar }}">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit Avatar</button>
            </div>

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::close() !!}
        </div>
    </div>
@stop
