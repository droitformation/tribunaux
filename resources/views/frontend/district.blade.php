@extends('layouts.new')
@section('sidebar')

    <?php
        $extras = collect([]);

        $extras = $extras->merge($district->canton->adresses);
        $extras = $extras->merge($district->extras);
        $extras = $extras->unique('id');
    ?>

    @include('frontend.partials.sidebar',
       [
            'canton_tribunaux'  => $canton->canton_tribunaux,
            'canton_donnees'    => $canton->canton_donnees,
            'tribunal_deuxieme' => $canton->tribunal_deuxieme,
            'tribunal_premier'  => $canton->tribunal_premier,
            'canton'            => $canton,
            'extras'            => $extras
        ]
    )

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a class="suisse" href="{{ url('/') }}"><img src="{{ asset('images/suisse.svg') }}" alt="{{ trans('carte.suisse') }}">{{ trans('carte.suisse') }}</a></li>
                <li><a href="{{ url('canton/'.$canton->id) }}"><i class="fa fa-map-pin"></i> {{ $canton->titre_trans }}</a></li>
                <li class="active">{{ $district->nom_trans }}</li>
                @if($district->autorites->count() == 1 || $district->autorites->isEmpty())
                    <li class="active">{{ $canton->titre_autorite->titre_trans }}</li>
                @endif
            </ul>
        </div>
    </div>
    <div class="row">
        @if(!$district->autorites->isEmpty())
            <div class="col-lg-4 col-md-3 col-xs-12">
                <section class="panel">
                    <div class="panel-body">
                        @include('frontend.partials.autorites',['dautorites' => $district->autorites])
                    </div>
                </section>
            </div>
        @endif
        <div class="{{ !$district->autorites->isEmpty() ? 'col-lg-8 col-md-9 ' : 'col-lg-12 col-md-12' }} col-xs-12">
            <!--timeline start-->
            <section class="panel">
                <div class="panel-body text-center">

                    <p class="backmap"><a href="{{ url('/') }}"> <i class="fa fa-arrow-circle-left"></i> &nbsp;{!! trans('carte.retour') !!}</a></p>

                    @include('frontend.partials.map',['id' => $district->id,'canton' => $district->canton_id, 'mapActive' => true, 'titles' => $titles])

                    {!! view('frontend/cantons/'.$district->canton_id) !!}
                </div>
            </section>
            <!--timeline end-->
        </div>
    </div>

@stop