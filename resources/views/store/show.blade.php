@extends('layout')

@section('title', $store->store_name.' in '.$store->city.', '.$store->region  )

@section('content')
    <div class="spa-page">
        @php
            $url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$store->place_id&key=AIzaSyBzdFYFjrrhcFmTjaPCaSF9XfAT2M3Sv4Y";
            $response = file_get_contents($url);
            $json = json_decode($response,true);

            $google_ratingValue = '';

            $has_google_reviews = isset($json['result']['reviews']);
            if($has_google_reviews) {
                $reviews = $json['result']['reviews'];
                $google_reviews_max_count = null;
                foreach($reviews as $rev) {
                    $google_reviews_max_count[] = $rev['rating'];
                }

                $google_ratingValue = $json['result']['rating'];
                $google_reviews_count = count($reviews);
                $google_reviews_max = max($google_reviews_max_count);
                $google_reviews_min = min($google_reviews_max_count);
            }
        @endphp
        <div class="page-title">
            <div class="contains">
                <h1>{!! $store->store_name !!}</h1>
            </div>
        </div>
        <div class="contains">
            <div class="row">
                <div class="inner-main cf" id="showpage">
                    <div class="inner-left">
                        @if(count($store->photos))
                            @foreach($store->photos->chunk(4) as $set)
                                <div class="spa-gallery">
                                    <section>
                                    @foreach($set as $photo)
                                        {{--<div class="gallery-img">
                                            <a href="{{ $photo->path }}" class="gallery">
                                                <img src="{{ $photo->thumbnail_path }}">
                                            </a>
                                            @if($user && $user->manages($store) || $user && $user->isAdmin())
                                                {!! linking_to('Delete', "/photos/{$photo->id}/name/{$store->store_name_slug}", 'DELETE') !!}
                                            @endif
                                        </div>--}}
                                        <div class="gallery-img">
                                            <a href="{{ $photo->path }}" data-lightbox="{{ $store->store_name_slug }}"><img src="{{ $photo->thumbnail_path }}"></a>
                                            @if($user && $user->manages($store) || $user && $user->isAdmin())
                                                {!! linking_to('Delete', "/photos/{$photo->id}/name/{$store->store_name_slug}", 'DELETE') !!}
                                            @endif
                                        </div>
                                    @endforeach
                                    </section>

                                </div>
                            @endforeach
                        @elseif($store->main_img)
                            <div class="img-area">
                                <img src="/{{ $store->main_img }}">
                            </div>
                        @else
                            <img src="http://placehold.it/400x200">
                        @endif
                        @if($store->store_description != '')
                            <div class="description">
                                <p class="section-title">Description: </p>
                                {!! nl2br($store->store_description) !!}
                            </div>
                        @endif
                        @if($store->notes)
                            <div class="notes">
                                <p class="section-title">Notes: </p>
                                {!! nl2br($store->notes) !!}
                            </div>
                        @endif
                        @if($store->price_30min || $store->price_45min || $store->price_1hour)
                            <div class="pricing-area">
                                <div class="room-fees">
                                    <p class="section-title">Room Fees: </p>
                                    @if($store->price_30min)
                                        <p><i class="fa fa-usd" aria-hidden="true"></i> 30 Mins: ${{ $store->price_30min }}</p>
                                    @endif
                                    @if($store->price_45min)
                                        <p><i class="fa fa-usd" aria-hidden="true"></i> 45 Mins: ${{ $store->price_45min }}</p>
                                    @endif
                                    @if($store->price_1hour)
                                        <p><i class="fa fa-usd" aria-hidden="true"></i> 1 Hour: ${{ $store->price_1hour }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="hours-area">
                            @if($store->store_hours)
                                <p class="section-title"><i class="fa fa-clock-o" aria-hidden="true"></i> Hours: </p>
                                {!! nl2br($store->store_hours) !!}
                            @endif
                        </div>
                        <div class="place-details">
                            @if($store->num_rooms)
                                <p class="section-title"><i class="fa fa-bed" aria-hidden="true"></i> Rooms: <strong>{{ $store->num_rooms }}</strong></p>
                            @endif
                            @if($store->num_showers)
                                <p class="section-title"><i class="fa fa-shower" aria-hidden="true"></i> Showers: <strong>{{ $store->num_showers }}</strong></p>
                            @endif
                            @if($store->parking)
                                <p class="section-title"><i class="fa fa-car" aria-hidden="true"></i>Parking: <strong>{{ ($store->parking == 1) ? 'Yes' : 'No' }}</strong></p>
                            @endif
                            @if($store->sauna)
                                <p class="section-title">Sauna: <strong>{{ ($store->sauna == 1) ? 'Yes' : 'No' }}</strong></p>
                            @endif
                            @if($store->jacuzzi)
                                <p class="section-title">Jacuzzi: <strong>{{ ($store->jacuzzi == 1) ? 'Yes' : 'No' }}</strong></p>
                            @endif
                            @if($store->atm_machine)
                                <p class="section-title"><i class="fa fa-credit-card" aria-hidden="true"></i>ATM Machine: <strong>{{ ($store->atm_machine == 1) ? 'Yes' : 'No' }}</strong></p>
                            @endif
                            @if($store->atm_anonymity)
                                <p class="section-title"><i class="fa fa-credit-card" aria-hidden="true"></i>Payment Anonymity: <strong>{{ ($store->atm_anonymity == 1) ? 'Yes' : 'No' }}</strong></p>
                            @endif
                        </div>

                        @if($store->ratings)
                            @include('store.comments')
                        @endif
                    </div>
                    <div class="inner-right">
                        <div class="location-area">
                            <div class="map-area">
                                <div id="map">
                                </div>
                            </div>
                            <div class="contact-details">
                                <span class="address"><a target="_blank" href="https://maps.google.com/?q={{ $store->store_address }}"><i class="fa fa-map-marker" aria-hidden="true"></i>{!! $store->store_address !!}</a></span>
                                <p><a href="tel:{!! $store->store_phone !!}"><i class="fa fa-phone" aria-hidden="true"></i>{!! $store->store_phone !!}</a></p>
                                @if($store->website)
                                    <p><a target="_blank" href="http://{!! $store->website !!}"><i class="fa fa-globe" aria-hidden="true"></i>{!! $store->website !!}</a></p>
                                @endif
                                @if($store->store_email)
                                    <p><a href="mailto:{!! $store->store_email !!}"><i class="fa fa-envelope-o" aria-hidden="true"></i>{!! $store->store_email !!}</a></p>
                                @endif
                                @if($store->established)
                                    <p>Established in {!! $store->established !!}</p>
                                @endif
                                <div class="general-ratings">
                                    <p class="rating-id">Our Rating</p>
                                    <div class="star-ratings-css">
                                        <div class="star-ratings-css-top" style="width: {{ $store_rating }}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                        <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                    </div>
                                    <p>({{ $rating_count }} {{ ($rating_count == 1) ? 'review' : 'reviews'  }})</p>
                                </div>
                                @if(!empty($google_ratingValue))
                                    <div class="general-ratings">
                                        <p class="rating-id">Google Rating</p>
                                        <div class="star-ratings-css">
                                            <div class="star-ratings-css-top" style="width: {{ ($google_ratingValue * 100)/5 }}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                            <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                        </div>
                                        <p>({{ $google_reviews_count }} {{ ($google_reviews_count == 1) ? 'review' : 'reviews'  }})</p>
                                    </div>
                                @endif
                                <div class="panel-footer">
                                    <favorite :spa={{ $store->id }} :favorited={{ $store->favorited() ? 'true' : 'false' }}></favorite>
                                </div>
                            </div>
                        </div>
                        <div class="write-review">
                            {{--@if (Auth::user() && Auth::user()->isSpaManager())--}}
                                {{--<a href="/manager-edit">Edit Your Spa</a>--}}
                            {{--@endif--}}
                            {{--@if ($signedIn && $user->isSpaManager() && $user->id == $store->managed_by)--}}
                            @if($user && $user->manages($store) || $user && $user->isAdmin())
                                <div class="manager-edit">
                                    {{--<a href="/manageredit/{{ $store->id }}">Edit Spa</a>--}}
                                    <a href="/store/{{ $store->id }}/manageredit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Edit Spa</span></a>
                                    @if(count($store->photos))
                                        <a href="/photos/{{ $store->photos[0]->store_id }}/pickimage"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Pick Main Image</span></a>
                                    @endif
                                </div>
                                <form action="{{ route('store_photo_path', [$store->store_name_slug]) }}"
                                      method="POST"
                                      class="dropzone" id="addPhotosForm">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                            <p class="review-expand dropdown-button" data-activates="review-dropdown"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Write A Review</span></p>

                            <span ref="spaid" class="spaid" style="display: none">{{ $store->id }}</span>
                            @if ($signedIn && !$store->hasRated())
                                <div class="ratings dropdown-content prevent-def" id="review-dropdown">
                                    <form method="post" action="/rate" enctype="multipart/form-data" class="rate-form">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="rating">Rate this location</label>
                                            <input type="hidden" name="store_id" value="{{ $store->id }}">

                                            <fieldset class="rating">
                                                <input type="radio" id="star5" v-model="rating" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4" v-model="rating" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3" v-model="rating" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2" v-model="rating" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" id="star1" v-model="rating" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                            </fieldset>
                                        </div>
                                        <br><br><br>
                                        <div class="form-group">
                                            <label for="comment">Leave a review</label>
                                            <textarea type="text" v-model="comment" name="comment" id="comment" class="form-control" rows="10">{{old('comment')}}</textarea>
                                        </div>
                                        <div class="input-field">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit Review</button>
                                        </div>
                                    </form>
                                </div>
                            @elseif($signedIn && $store->hasRated())
                                <div class="ratings dropdown-content prevent-def" id="review-dropdown">
                                    <h3 style="padding: 30px 0 0">You can only leave 1 review per spa</h3>
                                </div>
                            @else
                            <div class="ratings dropdown-content prevent-def" id="review-dropdown">
                                <h3 style="padding: 30px 0 0">You must be signed in to leave a review</h3>
                            </div>
                            @endif
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

                {{--<br><br><br>
                @if (Auth::user())
                    <div class="ratings">
                        <form method="post" action="/comment" enctype="multipart/form-data" class="comment-form">
                            {{ csrf_field() }}

                        </form>
                    </div>
                @endif--}}
                <br><br><br>
            </div>
        </div>
    </div>
    @if(count($store->ratings) > 0)
        <script type="application/ld+json">
            {
              "@context": "http://schema.org/",
              "@type": "LocalBusiness",
              "name": "{!! $store->store_name !!}",
              "description": "{{ (!empty($store->store_description) ? nl2br($store->store_description) : "Massage Parlour in ".$store->city.", ".$store->region) }}",
              "address": "{!! $store->store_address !!}",
              "telephone": "{!! $store->store_phone !!}",
              @if($mainPhoto)
              "image": "https://www.spapal.ca{{ $mainPhoto }}",
              @elseif($store->main_img)
              "image": "https://www.spapal.ca/{{ $store->main_img }}",
              @endif
              "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "{{ number_format($rating_avg, 1, '.', '') }}",
                "reviewCount": "{{ $rating_count }}",
                "bestRating": "{{ $rating_max }}",
                "worstRating": "{{ $rating_min }}"
              }
            }
        </script>
    @elseif($has_google_reviews)
        <script type="application/ld+json">
            {
              "@context": "http://schema.org/",
              "@type": "LocalBusiness",
              "name": "{!! $store->store_name !!}",
              "description": "{{ (!empty($store->store_description) ? nl2br($store->store_description) : "Massage Parlour in ".$store->city.", ".$store->region) }}",
              "address": "{!! $store->store_address !!}",
              "telephone": "{!! $store->store_phone !!}",
              @if($mainPhoto)
              "image": "https://www.spapal.ca{{ $mainPhoto }}",
              @elseif($store->main_img)
              "image": "https://www.spapal.ca/{{ $store->main_img }}",
              @endif
              "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "{{ $google_ratingValue }}",
                "reviewCount": "{{ $google_reviews_count }}",
                "bestRating": "{{ $google_reviews_max }}",
                "worstRating": "{{ $google_reviews_min }}"
              }
            }
        </script>
    @endif
@stop

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
    <script>
        Dropzone.options.addPhotosForm = {
            paramName: "photo", // The name that will be used to transfer the file
            maxFilesize: 3, // MB
            acceptedFiles: '.jpg, .jpeg, .png, .bmp, .gif'
        };
    </script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzzym-3p1s-IWmXF6kQ3Iqg2cmx8um-2E"></script>
    <script>
        function initMap() {

            // Create an array of styles.
            var lat = '{{ $store->lat }}';
            var lng = '{{ $store->lng }}';
            var spaName = '{{ $store->store_name }}';
            var latLng = new google.maps.LatLng(lat, lng);
            var centerage = new google.maps.LatLng(lat, lng);
            var styles = [{"featureType":"all","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"gamma":0.01},{"lightness":20}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"saturation":-31},{"lightness":-33},{"weight":2},{"gamma":0.8}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#050505"}]},{"featureType":"administrative.locality","elementType":"labels.text.stroke","stylers":[{"color":"#fef3f3"},{"weight":"3.01"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#0a0a0a"},{"visibility":"off"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.stroke","stylers":[{"color":"#fffbfb"},{"weight":"3.01"},{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":30},{"saturation":30}]},{"featureType":"poi","elementType":"geometry","stylers":[{"saturation":20}]},{"featureType":"poi.attraction","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"lightness":20},{"saturation":-20}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":10},{"saturation":-30}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"saturation":25},{"lightness":25}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#a1a1a1"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#292929"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#202020"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"simplified"},{"hue":"#0006ff"},{"saturation":"-100"},{"lightness":"13"},{"gamma":"0.00"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#686868"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"visibility":"off"},{"color":"#8d8d8d"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#353535"},{"lightness":"6"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":"3.45"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#d0d0d0"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"lightness":"2"},{"visibility":"on"},{"color":"#999898"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#383838"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"color":"#faf8f8"}]},{"featureType":"water","elementType":"all","stylers":[{"lightness":-20}]}];

            // Create a new StyledMapType object, passing it the array of styles,
            // as well as the name to be displayed on the map type control.
            var styledMap = new google.maps.StyledMapType(styles,
                    {name: "Styled Map"});

            // Create a map object, and include the MapTypeId to add
            // to the map type control.
            var mapOptions = {
                zoom: 13,
                center: centerage,
                mapTypeControlOptions: {
                    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                }
            };

            var map = new google.maps.Map(document.getElementById('map'),
                    mapOptions);

            //Associate the styled map with the MapTypeId and set it to display.
            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');
            var marker = new google.maps.Marker({
                position:latLng,
                map: map,
                icon: '/img/map_marker.png',
                title: spaName
            });
            marker.setMap(map);
        }
        initMap();

    </script>
@stop

