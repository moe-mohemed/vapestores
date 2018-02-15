
@extends('layout')

@section('content')
    <div class="contains">
        <h1>Change Main Spa Image</h1>
        <div class="row">
            {!! Form::model($photos, ['method' => 'PATCH','route' => ['photos.pickMainImageUpdate', '_ID_'], 'class'=> 'main-img-form']) !!}
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    @foreach($photos as $photo)
                        <div class="select-main-img" data-value="{{ $photo->id }}">
                            <img src="{{ $photo->path }}" class="{{ $photo->main_img == 1 ? 'selected-main-img' : '' }}">
                        </div>
                    @endforeach
                    <input type="hidden" name="store_id" id="store_id" class="form-control" value="{{ $photo->store_id }}">
                    <input type="hidden" name="main_img" id="main_img" class="form-control main-img-value" value="{{ $photo->main_img }}">
                </div>
            </div>

            <div class="input-field">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Spa Main Image</button>
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
