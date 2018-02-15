<div class="comments-area">

    @if(count($store->ratings) > 0 || $has_google_reviews)
    <ul class="tabs z-depth-1">
        @if(count($store->ratings) > 0)
            <li class="tab"><a href="#spapal-reviews">Our Reviews</a></li>
        @endif
        @if($has_google_reviews)
            <li class="tab"><a href="#google-reviews">Google Reviews</a></li>
        @endif
    </ul>
    @endif
    <div class="comments-main">

        @if(count($store->ratings) > 0)
        <div id="spapal-reviews">
        <h3>{{ $rating_count }} {{ ($rating_count == 1) ? 'review' : 'reviews'  }}</h3>
            <ul>
                @foreach($store->ratings as $rating)
                    <li>
                        <div class="author-avatar">
                            <img src="/img/avatars/{{ $rating->user->avatar }}" />
                        </div>
                        <div class="author-area">
                            <span class="author-name"><i class="fa fa-user" aria-hidden="true"></i> {{ $rating->user->username }}</span>
                            <div class="star-ratings-css">
                                <div class="star-ratings-css-top" style="width: {{ $rating->rating * 100/5 }}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
                            <span class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $rating->created_at->diffForHumans() }}</span>
                        </div>
                        @if($rating->comment)
                        <div class="main-comment">
                            <p>{{ $rating->comment }}</p>
                        </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
        @if($has_google_reviews)

        <div id="google-reviews">
            <div class="google-ratings">
                
                <h3>{{ $google_reviews_count }} {{ ($google_reviews_count == 1) ? 'review' : 'reviews'  }}</h3>
                <ul>
                @php
                    foreach($reviews as $review) {
                    # code...
                    $google_author_img = '';
                    $google_author = $review['author_name'];
                    if(isset($review['profile_photo_url'])){
                        $google_author_img = $review['profile_photo_url'];
                    }
                    $google_rating = $review['rating'];
                    $google_comment = $review['text'];
                    $google_review_time = $review['relative_time_description'];

                @endphp
                <li>
                    @if($google_author_img)
                        <div class="author-avatar">
                            <img src="{{ $google_author_img }}" />
                        </div>
                    @endif
                    <div class="author-area">
                        <span class="author-name"><i class="fa fa-user" aria-hidden="true"></i> {{ $google_author }}</span>
                        <div class="star-ratings-css">
                            <div class="star-ratings-css-top" style="width: {{ $google_rating * 100/5 }}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        </div>
                        <span class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $google_review_time }}</span>
                    </div>
                    @if($google_comment)
                        <div class="main-comment">
                            <p>{{ $google_comment }}</p>
                        </div>
                    @endif
                </li>
                @php
                    }
                @endphp
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>