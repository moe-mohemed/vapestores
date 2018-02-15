
<div class="cities">
    <ul>
        @foreach($cities as $stores)
            <li><a href="{{ $stores->city_slug }}">{!! $stores->city !!}{!! $stores->spacount !!}</a></li>
        @endforeach
    </ul>
</div>