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
                @elseif(isset($list_communes) && !$list_communes->isEmpty())
                    <?php
                        $locale   = (\Session::has('locale') && \Session::has('locale') == 'de' ? 'de_DE' : 'fr_FR');
                        $sorted   = $list_communes->sortAccent('nom_trans',$locale);
                    ?>

                    @foreach($sorted as $commune)
                        {!! $commune->nom_trans !!}<br/>
                    @endforeach
                @endif
            </div>
        </li>
    </ul>
</li>