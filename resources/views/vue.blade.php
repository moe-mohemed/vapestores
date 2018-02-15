@extends('layout')

@section('title', 'Vue')

@section('content')
    <div class="contains">
        <div id="vueroot">
            <ul>
                <li v-for="skill in skills">@{{ skill }}</li>
            </ul>
        </div>
    </div>
@stop