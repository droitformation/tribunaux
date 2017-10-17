<div class="the_map">
    <?php
        $default = 'cantons/'.$canton.'.png';
        $map     = 'cantons/active/'.$canton.'-'.$id.'.png';
        $active  = 'cantons/'.$id.'.png';
        $src     = (isset($mapActive) && $mapActive ? $map : $active);
    ?>

    @if(isset($titles) && !$titles->isEmpty())
        @foreach($titles as $title)
            <?php $position = explode(',',$title['position']);  ?>
            <h4 style="position: absolute; z-index: 1000; top: {{ $position[0] - 25 }}px; left: {{ $position[1] }}px;">{{ $title['nom'] }}</h4>
        @endforeach
    @endif

    @if (File::exists($src))
        <img src="{{ url('/').'/'.$src }}" alt="map" width="610" height="560" border="0" usemap="#Map" />
    @else
        <img src="{{ url('/').'/'.$default }}" alt="map" width="610" height="560" border="0" usemap="#Map" />
    @endif
</div>