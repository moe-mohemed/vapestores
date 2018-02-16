<div class="spa-container">
    @foreach($store as $stores)
        <div class="single-spa">
            <a href="/{{ $stores->region_slug }}/{{ $stores->city_slug }}/{{ $stores->store_name_slug }}">
            <div class="top-img">
                    @if($stores->mainListingImage)
                        <img src="{{ $stores->mainListingImage }}">
                    @elseif($stores->main_img)
                        <img src="/{{ $stores->main_img }}">
                    @else
                        <img src="http://placehold.it/400x200">
                    @endif
            </div>
            </a>
            @if ($signedIn && $user->isAdmin())
                <div class="edit">
                    <a href="{{ route('store.edit',$stores->id)}}">Edit Spa</a>
                </div>
            @endif
            <div class="city">
                @if($stores->city)
                    <p><strong>{{ $stores->city }}</strong></p>
                @endif
            </div>
            <div class="spa-details">
                <div class="spa-main">
                    @if(count($stores->ratings) >= 1)
                        <p class="rating-id">Our Rating</p>
                        <div class="star-ratings-css">
                            <div class="star-ratings-css-top" style="width: {{ $stores->ratingAvg }}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        </div>
                    @else
                        <p class="rating-id">Our Rating</p>
                        <div class="star-ratings-css">
                            <div class="star-ratings-css-top" style="width: 0;"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        </div>
                    @endif
                    @if($stores->google_rating >= 1)
                        <p class="rating-id">Google Rating</p>
                        <div class="star-ratings-css">
                            <div class="star-ratings-css-top" style="width: {{ ($stores->google_rating * 100)/5 }}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        </div>
                    @endif  
                    <div class="listing-actions">
                        @if($stores->price_30min || $stores->price_45min || $stores->price_1hour)
                            <p class="price-click">
                                Pricing <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                            </p>
                            <div class="pricing-pop">
                                @if($stores->price_30min)
                                    <p>30 Mins: ${{ $stores->price_30min }}</p>
                                @endif
                                @if($stores->price_45min)
                                    <p>45 Mins: ${{ $stores->price_45min }}</p>
                                @endif
                                @if($stores->price_1hour)
                                    <p>1 Hour: ${{ $stores->price_1hour }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <h2><a href="/{{ $stores->region_slug }}/{{ $stores->city_slug }}/{{ $stores->store_name_slug }}">{!! $stores->store_name !!}</a></h2>
                    <h3><i class="fa fa-map-marker" aria-hidden="true"></i><a target="_blank" href="https://maps.google.com/?q={{ $stores->store_address }}">{!! $stores->store_address !!}</a></h3>
                    @if($stores->store_phone)
                            <h3><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:{{ $stores->store_phone }}">{!! $stores->store_phone !!}</a></h3>
                    @endif
                    <div class="facility-details">
                        @if($stores->num_rooms)
                            <p>Rooms: <strong>{{ $stores->num_rooms }}</strong></p>
                        @endif
                        @if($stores->num_showers)
                            <p>Showers: <strong>{{ $stores->num_showers }}</strong></p>
                        @endif
                        @if($stores->parking)
                            <p><img src="/img/parking.png"> <strong>{{ ($stores->parking == 1) ? 'Yes' : 'No' }}</strong></p>
                        @endif

                        @if($stores->ratings()->count() >= 1)
                            <div class="ratings">
                                <p><i class="fa fa-comments" aria-hidden="true"></i> {{ $stores->ratings()->count() }} {{ ($stores->ratings()->count() == 1) ? 'review' : 'reviews'  }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="panel-footer">
                        <favorite :store={{ $stores->id }} :favorited={{ $stores->favorited() ? 'true' : 'false' }}></favorite>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>