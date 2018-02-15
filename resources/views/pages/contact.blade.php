@extends('layout')

@section('title', 'SpaPal')

@section('content')
    <div class="contact-pg">
        <div class="page-title">
            <div class="contains">
                <h1>Contact Us</h1>
            </div>
        </div>
        <div class="contains">
            <div class="contact-msg"><p>Please use this form if you've noticed any bugs, have a suggestion, would like to add a spa or for general inquiries.</p></div>
            <form method="post" action="/sendmail" enctype="multipart/form-data" class="contact-form">
                {{ csrf_field() }}
                <div class="input-field">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="input-field">
                    <label for="email">Your Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="input-field">
                    <label for="message">Your Message</label>
                    <textarea type="text" name="message" id="message" class="materialize-textarea form-control" rows="10">{{old('message')}}</textarea>
                </div>
                <div class="input-field">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Send</button>
                </div>
            </form>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
        </div>
    </div>

@stop

@section('scripts.footer')
@stop