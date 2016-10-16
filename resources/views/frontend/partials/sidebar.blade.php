@if(isset($commune))
    @include('frontend.lists.communes', ['commune' => $commune])
@elseif(isset($autorite->communes) && !$autorite->communes->isEmpty())
    @include('frontend.lists.communes', ['communes' => $autorite->communes])
@elseif(isset($district->communes) && !$district->communes->isEmpty() && !$district->multiple_autorite)
    @include('frontend.lists.communes', ['communes' => $district->communes])
@elseif(!isset($district) && !isset($autorite))
    @include('frontend.lists.communes', ['communes' => $canton->communes])
@endif

@if(isset($extras) && $extras)
    @foreach($extras as $extra)
        <li class="sub-menu">
            <a class="sublink" href="javascript:;"><i class="fa fa-angle-right"></i><span>{{ $extra->titre_trans }}</span></a>
            <ul class="sub">
                <li>{!! $extra->contenu_trans !!}</li>
            </ul>
        </li>
    @endforeach
@endif

@if($canton->is_second_level)
    <li class="sub-menu">
        <a class="sublink" href="javascript:;">
            <i class="fa fa-angle-right"></i>
            <span>{{ isset($canton->autorites) && !$canton->autorites->isEmpty() ? $canton->autorites->first()->nom_trans : trans('carte.autorite') }}</span>
        </a>
        <ul class="sub">
            <li>
                @if(isset($canton->autorites) && !$canton->autorites->isEmpty() && $canton->autorites->first()->siege != '')
                    <p>{!! $canton->autorites->first()->siege_trans !!}</p>
                @else
                    <p>{!! $canton->canton_tribunaux->siege !!}</p>
                @endif
            </li>
        </ul>
    </li>
@endif

@if(isset($autorite))
    <li class="sub-menu">
        <a class="sublink" href="javascript:;">
            <i class="fa fa-angle-right"></i>
            <span>{{ trans('carte.autorite') }}</span>
        </a>
        <ul class="sub">
            <li>
                @if( empty($canton->canton_tribunaux->siege) )
                    @if($autorite->siege != '')
                        <p>{!! $autorite->siege_trans !!}</p>
                    @else
                        <p>{!! $canton->canton_tribunaux->siege !!}</p>
                    @endif
                @else
                    <p>{!! $canton->canton_tribunaux->siege !!}</p>
                @endif
            </li>
        </ul>
    </li>
@endif

@if(isset($canton_tribunaux))

    @if(isset($district))
        <?php $info = ($canton_tribunaux->premier != '' ? $canton_tribunaux->premier : $district->tribunal_trans); ?>
    @elseif(isset($autorite->district))
        <?php $info = ($canton_tribunaux->premier != '' ? $canton_tribunaux->premier : $autorite->district->tribunal_trans); ?>
    @elseif(!empty($canton_tribunaux->premier))
        <?php $info = $canton_tribunaux->premier; ?>
    @endif

    @if(isset($info))
        <li class="sub-menu">
            <a class="sublink" href="javascript:;"><i class="fa fa-angle-right"></i><span>{{ $tribunal_premier->titre_trans }}</span></a>
            <ul class="sub">
                <li>{!! $info !!}</li>
            </ul>
        </li>
    @endif

    <li class="sub-menu">
        <a class="sublink" href="javascript:;"><i class="fa fa-angle-right"></i><span>{{ $tribunal_deuxieme->titre_trans }}</span></a>
        <ul class="sub">
            <li>{!! $canton_tribunaux->deuxieme !!}</li>
        </ul>
    </li>

@endif

<!-- Données générales pour toute le canton -->
@if(isset($canton_donnees) && !$canton_donnees->isEmpty())
    @foreach($canton_donnees as $donnees)
        <li class="sub-menu">
            <a class="sublink" href="javascript:;"><i class="fa fa-angle-right"></i><span>{{ $donnees->titre_trans }}</span></a>
            <ul class="sub">
                <li>{!! $donnees->contenu_trans !!}</li>
            </ul>
        </li>
    @endforeach
@endif
