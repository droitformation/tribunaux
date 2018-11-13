@if(isset($commune))
    @include('frontend.lists.communes', ['list_communes' => $commune])
@elseif(isset($autorite->communes) && !$autorite->communes->isEmpty())
    @include('frontend.lists.communes', ['list_communes' => $autorite->communes])
@elseif(isset($district->communes) && !$district->communes->isEmpty() && ($canton->is_second_level || $district->autorites->isEmpty()))
    @include('frontend.lists.communes', ['list_communes' => $district->communes])
@elseif(!isset($district) && !isset($autorite) && $canton->is_second_level)
    @include('frontend.lists.communes', ['list_communes' => $canton->communes])
@endif

@if($canton->is_second_level || (isset($district) && $district->autorites->isEmpty()) )
    <li class="sub-menu">
        <a class="sublink" href="javascript:;">
            <i class="fa fa-angle-right"></i>
            <span>{{ isset($canton->autorites) && !$canton->autorites->isEmpty() ? $canton->autorites->first()->nom_trans : trans('carte.autorite') }}</span>
        </a>
        <ul class="sub">
            <li>
                @if(isset($canton->autorites) && !$canton->autorites->isEmpty() && $canton->autorites->first()->siege != '')
                    <div>{!! $canton->autorites->first()->siege_trans !!}</div>
                @else
                    <div>{!! $canton->canton_tribunaux->siege !!}</div>
                @endif
            </li>
        </ul>
    </li>
@endif

@if(isset($autorite))
    <li class="sub-menu">
        <a class="sublink" href="javascript:;">
            <i class="fa fa-angle-right"></i>
            <span>{{ $canton->titre_autorite->titre_trans }}</span>
        </a>
        <ul class="sub">
            <li>
                @if( empty($canton->canton_tribunaux->siege) )
                    @if($autorite->siege != '')
                        <div>{!! $autorite->siege_trans !!}</div>
                    @else
                        <div>{!! $canton->canton_tribunaux->siege !!}</div>
                    @endif
                @else
                    <div>{!! $canton->canton_tribunaux->siege !!}</div>
                @endif
            </li>
        </ul>
    </li>
@endif

@if(!$extras->isEmpty())
    @foreach($extras as $extra)
        <li class="sub-menu">
            <a class="sublink" href="javascript:;"><i class="fa fa-angle-right"></i><span>{{ $extra->titre_trans }}</span></a>
            <ul class="sub">
                <li><div>{!! $extra->contenu_trans !!}</div></li>
            </ul>
        </li>
    @endforeach
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
                <li><div>{!! $info !!}</div></li>
            </ul>
        </li>
    @endif

    <li class="sub-menu">
        <a class="sublink" href="javascript:;"><i class="fa fa-angle-right"></i><span>{{ $tribunal_deuxieme->titre_trans }}</span></a>
        <ul class="sub">
            <li><div>{!! $canton_tribunaux->deuxieme !!}</div></li>
        </ul>
    </li>

@endif

<!-- Données générales pour toute le canton -->
@if(isset($canton_donnees) && !$canton_donnees->isEmpty())
    @foreach($canton_donnees as $donnees)
        <li class="sub-menu">
            <a class="sublink" href="javascript:;"><i class="fa fa-angle-right"></i><span>{{ $donnees->titre_trans }}</span></a>
            <ul class="sub">
                <li>
                    <div>{!! $donnees->contenu_trans !!}</div>
                </li>
            </ul>
        </li>
    @endforeach
@endif
