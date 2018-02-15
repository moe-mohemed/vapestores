
@extends('layout')

@section('content')
    <div class="contains">
        <h1>Edit Spa</h1>
        <div class="row">
            {{--<form method="patch" action="{{ route('store.update', $store->id)}}" enctype="multipart/form-data" class="col-md-6 create-form">--}}
            {!! Form::model($store, ['method' => 'PATCH','route' => ['store.update', $store->id], 'class'=> 'create-form']) !!}
                <div class="input-field">
                    <label for="store_name">Spa Name</label>
                    <input type="text" name="store_name" id="store_name" class="form-control" value="{{ $store->store_name }}">
                </div>

                <div class="input-field">
                    <label for="city">Address</label>
                    <input type="text" name="store_address" id="store_address" class="form-control" value="{{ $store->store_address }}">
                </div>
                <div class="input-field">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ $store->city }}">
                </div>
                <div class="input-field">
                    <label for="store_phone">Phone #</label>
                    <input type="text" name="store_phone" id="store_phone" class="form-control" value="{{ $store->store_phone }}">
                </div>
                <div class="input-field">
                    <label for="num_rooms">Number of Rooms</label>
                    <input type="number" name="num_rooms" id="num_rooms" class="form-control" value="{{ $store->num_rooms }}">
                </div>

                <div class="input-field">
                    <label for="num_showers">Number of Showers</label>
                    <input type="number" name="num_showers" id="num_showers" class="form-control" value="{{ $store->num_showers }}">
                </div>

                <div class="input-field">
                    <label for="established">Established</label>
                    <input type="text" name="established" id="established" class="form-control" value="{{ $store->established }}">
                </div>

                <div class="input-field">
                    <label for="sp_email">Email</label>
                    <input type="text" name="store_email" id="store_email" class="form-control" value="{{ $store->store_email }}">
                </div>
                <div class="input-field">
                    <label for="website">Website</label>
                    <input type="text" name="website" id="website" class="form-control" value="{{ $store->website }}">
                </div>
                <div class="input-field">
                    <label for="store_hours">Hours</label>
                    <textarea type="text" name="store_hours" id="store_hours" class="materialize-textarea form-control" rows="4">{{ $store->store_hours }}</textarea>
                </div>
                <div class="form-group">
                    <label for="sauna">Sauna</label>
                    <input type="radio" id="saunayes" name="sauna" value="1" @if($store->sauna ==  1) checked="checked" @endif />
                    <label for="saunayes">Yes</label>
                    <input type="radio" id="saunano" name="sauna" value="0" @if($store->sauna ==  0) checked="checked" @endif />
                    <label for="saunano">No</label>
                </div>
                <div class="form-group">
                    <label for="jacuzzi">Jacuzzi</label>
                    <input type="radio" id="jacuzziyes" name="jacuzzi" value="1" @if($store->jacuzzi ==  1) checked="checked" @endif />
                    <label for="jacuzziyes">Yes</label>
                    <input type="radio" id="jacuzzino" name="jacuzzi" value="0" @if($store->jacuzzi ==  0) checked="checked" @endif />
                    <label for="jacuzzino">No</label>
                </div>
                <div class="form-group">
                    <label for="parking">Parking</label>
                    <input type="radio" id="parkingyes" name="parking" value="1" @if($store->parking ==  1) checked="checked" @endif />
                    <label for="parkingyes">Yes</label>
                    <input type="radio" id="parkingno" name="parking" value="0" @if($store->parking ==  0) checked="checked" @endif />
                    <label for="parkingno">No</label>
                </div>
                <div class="form-group">
                    <label for="atm_machine">ATM Machine</label>
                    <input type="radio" id="atm_machineyes" name="atm_machine" value="1" @if($store->atm_machine ==  1) checked="checked" @endif />
                    <label for="atm_machineyes">Yes</label>
                    <input type="radio" id="atm_machineno" name="atm_machine" value="0" @if($store->atm_machine ==  0) checked="checked" @endif />
                    <label for="atm_machineno">No</label>
                </div>
                <div class="form-group">
                    <label for="atm_anonymity">ATM Machine Anonymity</label>
                    <input type="radio" id="atm_anonymityyes" name="atm_anonymity" value="1" @if($store->atm_anonymity ==  1) checked="checked" @endif />
                    <label for="atm_anonymityyes">Yes</label>
                    <input type="radio" id="atm_anonymityno" name="atm_anonymity" value="0" @if($store->atm_anonymity ==  0) checked="checked" @endif />
                    <label for="atm_anonymityno">No</label>
                </div>
                <div class="input-field pricing inline col s12">
                    <p for="pricing">Pricing</p>
                    <div class="input-field price cf">
                        <input type="text" name="price_30min" id="price_30min" class="form-control" value="{{ $store->price_30min }}">
                        <label for="price_30min">30 Mins</label>
                    </div>
                    <div class="input-field price cf">
                        <input type="text" name="price_45min" id="price_45min" class="form-control" value="{{ $store->price_45min }}">
                        <label for="price_45min">45 Mins</label>
                    </div>
                    <div class="input-field price cf">
                        <input type="text" name="price_1hour" id="price_1hour" class="form-control" value="{{ $store->price_1hour }}">
                        <label for="price_1hour">1 Hour</label>
                    </div>
                </div>
                <div class="input-field">
                    <label for="store_description">Description</label>
                    <textarea type="text" name="store_description" id="store_description" class="materialize-textarea form-control" rows="10">{{ $store->store_description }}</textarea>
                </div>
                <div class="input-field">
                    <label for="notes">Notes</label>
                    <textarea type="text" name="notes" id="notes" class="materialize-textarea form-control" rows="5">{{ $store->notes }}</textarea>
                </div>

                <div class="input-field">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update Spa</button>
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
