@extends('layouts.master')

@section('sidebar')

    <?php
    if(!$autorite->canton->extras->isEmpty()) {
        $extras = $autorite->canton->extras;
    }

    if(isset($autorite->district) && !$autorite->district->extras->isEmpty()) {
        $extras = $autorite->district->extras;
    }

    if(!$autorite->extras->isEmpty()) {
        $extras = $autorite->extras;
    }
    ?>

    @include('frontend.partials.sidebar',
        [
            'canton_tribunaux'  => $canton->canton_tribunaux,
            'canton_donnees'    => $canton->canton_donnees,
            'tribunal_deuxieme' => $canton->tribunal_deuxieme,
            'tribunal_premier'  => $canton->tribunal_premier,
            'canton'   => $canton,
            'district' => $autorite->district,
            'autorite' => $autorite,
            'extras'   => (isset($extras) ? $extras : null)
        ]
    )

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a class="suisse" href="{{ url('/') }}"><img src="{{ asset('images/suisse.svg') }}" alt="{{ trans('carte.suisse') }}">{{ trans('carte.suisse') }}</a></li>
                <li><a href="{{ url('canton/'.$canton->id) }}"><i class="fa fa-map-pin"></i> {{ $canton->titre_trans }}</a></li>
                @if(isset($autorite->district))
                    <li><a href="{{ url('district/'.$autorite->district->id) }}"><i class="fa fa-map-pin"></i> {{ $autorite->district->nom_trans }}</a></li>
                @endif
                <li class="active">{{ $autorite->nom_trans }}</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <!--timeline start-->
            <section class="panel">
                <div class="panel-body text-center">

                    <p class="backmap"><a href="{{ url('/') }}"> <i class="fa fa-arrow-circle-left"></i> &nbsp;{!! trans('carte.retour') !!}</a></p>

                    <?php $id        = (isset($autorite->district) ? $autorite->district->id : $autorite->canton_id ); ?>
                    <?php $canton    = (isset($autorite->district) ? $autorite->canton_id : null); ?>
                    <?php $mapActive = (isset($autorite->district) ? true : false); ?>

                    @include('frontend.partials.map',['id' => $id, 'canton' => $canton, 'mapActive' => $mapActive, 'titles' => $titles])

                    {!! view('frontend/cantons/'.$autorite->canton_id) !!}
                </div>
            </section>
            <!--timeline end-->
        </div>
    </div>

@stop