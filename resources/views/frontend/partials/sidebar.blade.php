<article class="info">
    <div class="accordion" style="display:none;">

        @if(isset($commune))
            <h3><a href="#">{{ trans('carte.commune_singular') }}</a></h3>
            <div style="max-height:150px;">
                <p> {!! $commune->nom_trans !!}</p>
            </div>
        @endif

        @if(isset($autorite->communes) && !$autorite->communes->isEmpty())
            <h3><a href="#">{{ trans('carte.commune_plurial') }}</a></h3>
            <div style="max-height:150px;">
                <p>
                    @foreach($autorite->communes as $commune)
                        {!! $commune->nom_trans !!}<br/>
                    @endforeach
                </p>
            </div>
        @endif

        @if(isset($district->communes) && !$district->communes->isEmpty() && !$district->multiple_autorite)
            <h3><a href="#">{{ trans('carte.commune_plurial') }}</a></h3>
            <div style="max-height:150px;">
                <p>
                    @foreach($district->communes as $commune)
                        {!! $commune->nom_trans !!}<br/>
                    @endforeach
                </p>
            </div>
        @endif

        @if(isset($extras) && $extras)
            @foreach($extras as $extra)
                <h3><a href="#">{{ $extra->titre_trans }}</a></h3>
                <div style="max-height:150px;">
                    {!! $extra->contenu_trans !!}<br/>
                </div>
            @endforeach
        @endif

        @if($canton->districts->count() == 0 && $canton->autorites->count() == 1 || (isset($district) && $canton->autorites->count() == 1))
            <h3><a href="#">{{ $canton->autorites->first()->nom_trans }}</a></h3>
            <div style="max-height:150px;">
                @if($canton->autorites->first()->siege != '')
                    <p>{!! $canton->autorites->first()->siege_trans !!}</p>
                @else
                    <p>{!! $canton->canton_tribunaux->siege_trans !!}</p>
                @endif
            </div>
        @elseif(isset($autorite))
            @if( empty($canton->canton_tribunaux->siege) )
                <h3><a href="#">Autorité de conciliation</a></h3>
                <div style="max-height:150px;">
                    @if($autorite->siege != '')
                        <p>{!! $autorite->siege_trans !!}</p>
                    @else
                        <p>{!! $canton->canton_tribunaux->siege_trans !!}</p>
                    @endif
                </div>
            @else
                <h3><a href="#">Autorité de conciliation</a></h3>
                <div style="max-height:150px;">
                    <p>{!! $canton->canton_tribunaux->siege !!}</p>
                </div>
            @endif

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
                <h3><a href="#">{{ $tribunal_premier->titre_trans }}</a></h3>
                <div style="max-height:150px;">
                    <p>{!! $info !!}</p>
                </div>
            @endif

            <h3><a href="#">{{ $tribunal_deuxieme->titre_trans }}</a></h3>
            <div style="max-height:150px;">
                <p>{!! $canton_tribunaux->deuxieme !!}</p>
            </div>

        @endif

        <!-- Données générales pour toute le canton -->
        @if(isset($canton_donnees) && !$canton_donnees->isEmpty())
            @foreach($canton_donnees as $donnees)
                <h3><a href="#">{{ $donnees->titre_trans }}</a></h3>
                <div style="max-height:150px;">
                    <p>{!! $donnees->contenu_trans !!}</p>
                </div>
            @endforeach
        @endif

    </div>
</article>
