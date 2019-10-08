<div id="map-container" data-width="610" data-height="580">
    <div class="the_map">
        <?php
            $default = 'cantons/'.$canton.'.png';
            $map     = 'cantons/active/'.$canton.'-'.$id.'.png';
            $active  = 'cantons/'.$id.'.png';
            $src     = (isset($mapActive) && $mapActive ? $map : $active);
        ?>

        @if(isset($titles) && !$titles->isEmpty())
            @foreach($titles as $title)
                <h4 class="pin-map" data-top="{{ $title['position']['x'] }}" data-left="{{ $title['position']['y'] }}" style="top: {{ $title['position']['x'] }}px; left: {{ $title['position']['y'] }}px;">
                    <a href="{{ $title['link'] }}">{{ $title['nom'] }}</a>
                </h4>
            @endforeach
        @endif

        @if (File::exists($src))
            <img src="{{ url('/').'/'.$src }}" alt="map" border="0" usemap="#Map" />
        @else
            <img src="{{ url('/').'/'.$default }}" alt="map" border="0" usemap="#Map" />
        @endif
    </div>
</div>