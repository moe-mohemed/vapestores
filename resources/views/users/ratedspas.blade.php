@extends('layout')

@section('title', 'Your Ratings' )

@section('content')
    <div class="contains">
        <div class="spa-container">
            @if($ratings->count() > 0)
                @foreach($ratings as $rate)
                    <div class="single-rated-spa">

                        <div class="spa-link"><a href="/{{ $rate->spa->region_slug }}/{{ $rate->spa->city_slug }}/{{ $rate->spa->store_name_slug }}"><h3>{{ $rate->spa->store_name}}</h3></a></div>
                        <div class="rated-comment">
                            <span>Your Comment:</span>
                            <p>{{ $rate->comment }}</p>
                        </div>
                        <div class="rating-start">
                            <div class="star-ratings-css">
                                <div class="star-ratings-css-top" style="width: {{ ($rate->rating * 100)/5 }}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
                        </div>
                        <div class="rating-date">
                            <p>{{ $rate->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <h4>Looks like you haven't rated any spas. Rate the spas you've been to and they will show up here.</h4>
            @endif
        </div>

    </div>


@stop