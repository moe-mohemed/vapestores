
{{ csrf_field() }}
<div class="input-field col s12">
    <label for="store_name">Spa Name</label>
    <input type="text" name="store_name" id="store_name" class="form-control" value="{{ old('store_name') }}">
</div>

<div class="input-field col s12">
    <label for="store_address">Address</label>
    <input type="text" name="store_address" id="store_address" class="form-control" value="{{ old('store_address') }}">
</div>
<div class="input-field col s12">
    <label for="city">City</label>
    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
</div>
{{--<div class="input-field col s12">
    <label for="province">Province</label>
    <select id="province" name="province" class="form-control">
        @foreach($countries::all() as $name => $code)
            <option value="{{ $name }}">{{ $name }}</option>
        @endforeach
    </select>
</div>

<div class="input-field col s12">
    <label for="city">City</label>
    <select id="city" name="city" class="form-control">
        <option value="" disabled>Select A State</option>
    </select>
</div>--}}
<div class="input-field col s12">
    <label for="store_phone">Phone #</label>
    <input type="text" name="store_phone" id="store_phone" class="form-control" value="{{ old('store_phone') }}">
</div>
<div class="input-field col s12">
    <label for="established">Established</label>
    <input type="text" name="established" id="established" class="form-control" value="{{ old('established') }}">
</div>

<div class="input-field col s12">
    <label for="sp_email">Email</label>
    <input type="text" name="store_email" id="store_email" class="form-control" value="{{ old('store_email') }}">
</div>
<div class="input-field col s12">
    <label for="website">Website</label>
    <input type="text" name="website" id="website" class="form-control" value="{{ old('website') }}">
</div>
<div class="input-field col s12">
    <label for="store_hours">Hours</label>
    <textarea type="text" name="store_hours" id="store_hours" class="materialize-textarea form-control" rows="4">{{old('store_hours')}}</textarea>
</div>
<div class="form-group">
    <label for="parking">Parking</label>
    <input type="radio" id="parkingyes" name="parking" value="1" @if(old('parking') ==  1) checked="checked" @endif />
    <label for="parkingyes">Yes</label>
    <input type="radio" id="parkingno" name="parking" value="0" @if(old('parking') ==  0) checked="checked" @endif />
    <label for="parkingno">No</label>
</div>
<div class="form-group">
    <label for="atm_machine">ATM Machine</label>
    <input type="radio" id="atm_machineyes" name="atm_machine" value="1" @if(old('atm_machine') ==  1) checked="checked" @endif />
    <label for="atm_machineyes">Yes</label>
    <input type="radio" id="atm_machineno" name="atm_machine" value="0" @if(old('atm_machine') ==  0) checked="checked" @endif />
    <label for="atm_machineno">No</label>
</div>
<div class="input-field col s12">
    <label for="store_description">Description</label>
    <textarea type="text" name="store_description" id="store_description" class="materialize-textarea form-control" rows="10">{{old('store_description')}}</textarea>
</div>
<div class="input-field col s12">
    <label for="notes">Notes</label>
    <textarea type="text" name="notes" id="notes" class="materialize-textarea form-control" rows="5">{{old('notes')}}</textarea>
</div>

<div class="input-field col s12">
    <button type="submit" class="btn btn-primary">Add Spa</button>
</div>

