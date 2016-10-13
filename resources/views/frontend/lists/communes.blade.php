<li class="sub-menu">
    <a class="sublink" href="javascript:;">
        <i class="fa fa-home"></i>
        <span>{{ trans('carte.commune_plurial') }}</span>
    </a>
    <ul class="sub">
        <li>
            <p>
                @if(isset($commune))
                    {!! $commune->nom_trans !!}<br/>
                @elseif(isset($communes) && !$communes->isEmpty())
                    @foreach($communes as $commune)
                        {!! $commune->nom_trans !!}<br/>
                    @endforeach
                @endif
            </p>
        </li>
    </ul>
</li>