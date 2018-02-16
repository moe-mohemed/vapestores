<!-- sidebar nav -->
<div class="sidebar" id="citiesId">
    <div class="logo">
        <a href="/home"><h3 style="text-align: center; color: #fff;">VapeStoreMaps</h3></a>
    </div>
    <div class="navage-sidebar">
        <ul>
            <li class="{{ Request::is( '/') ? 'active' : '' }}"><a href="/">Home</a></li>
            <li class="{{ Request::is( 'about') ? 'active' : '' }}"><a href="#about">About</a></li>
            <li class="{{ Request::is( 'contact') ? 'active' : '' }}"><a href="/contact">Contact</a></li>
        </ul>
    </div>
    <div class="scroll-area">
        <div class="scroll-up">
            <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
        </div>
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
        <div class="scroll-down">
            <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
        </div>
        <div class="cities" id="nonitembased">
            <ul class="slidee">
                {{--{{ dd($loc) }}--}}
                @foreach($loc as $region)
                    <li><div class="province-link"><span class="region">{{ $region['region'] }}<i class="fa fa-level-down" aria-hidden="true"></i></span></div>
                        <ul>
                            @foreach($region['cities'] as $city)
                                <li><a href="/{{ $city->region_slug }}/{{ $city->city_slug }}"><span class="location">{{ $city->city }}</span><span class="count">{{ $city->counts }}</span></a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                {{--@foreach($loc as $key => $stores)
                    <li><a href="{{ $stores }}"><span class="location">{!! $stores !!}</span><span class="count">{!! $stores !!}</span></a></li>
                @endforeach--}}
                {{--@foreach($loc as $key => $val)
                    --}}{{--<li><a href="{{ $reg['region'] }}"><span class="location">{!! $reg['region'] !!}</span><span class="count">{!! $reg['region'] !!}</span></a></li>--}}{{--
                    <li><a href="{{ print_r($val) }}"></a></li>
                @endforeach--}}
            </ul>
        </div>
    </div>
</div>