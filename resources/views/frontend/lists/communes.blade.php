<li class="sub-menu">
    <a class="sublink active" href="javascript:;">
        <i class="fa fa-angle-right"></i>
        <span>{{ trans('carte.commune_plurial') }}</span>
    </a>
    <ul class="sub">
        <li>
            <div>
                @if(isset($commune))
                    {!! $commune->nom_trans !!}<br/>
                @elseif(isset($communes) && !$communes->isEmpty())
                    @foreach($communes as $commune)
                        {!! $commune->nom_trans !!}<br/>
                    @endforeach
                @endif
            </div>
        </li>
    </ul>
</li>