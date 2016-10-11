<h3><a href="#">{{ trans('carte.commune_plurial') }}</a></h3>
<div style="max-height:150px;">
    <p>
        @if(isset($commune))
            {!! $commune->nom_trans !!}<br/>
        @elseif(isset($communes) && !$communes->isEmpty())
            @foreach($communes as $commune)
                {!! $commune->nom_trans !!}<br/>
            @endforeach
        @endif
    </p>
</div>