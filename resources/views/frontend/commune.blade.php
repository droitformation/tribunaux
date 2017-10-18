@extends('layouts.master')

@section('sidebar')

    <?php

        $extras = collect([]);
        $extras = $extras->merge($commune->canton->adresses);

        if(isset($commune->district)) {
            $extras = $extras->merge($commune->district->extras);
        }

        if(isset($commune->autorite)) {
            $extras = $extras->merge($commune->autorite->extras);
        }

        $extras = $extras->unique('id');
    ?>

    @include('frontend.partials.sidebar',
        [
            'canton_tribunaux'  => $commune->canton->canton_tribunaux,
            'canton_donnees'    => $commune->canton->canton_donnees,
            'tribunal_deuxieme' => $commune->canton->tribunal_deuxieme,
            'tribunal_premier'  => $commune->canton->tribunal_premier,
            'canton'            => $commune->canton,
            'extra'             => $extras,
            'district'          => isset($commune->district) ? $commune->district : null,
            'autorite'          => isset($commune->autorite) ? $commune->autorite : null,
        ]
    )

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ url('canton/'.$canton->id) }}"><i class="fa fa-map-pin"></i> {{ $canton->titre_trans }}</a></li>
                @if(isset($commune->district))
                    <li><a href="{{ url('district/'.$commune->district->id) }}"><i class="fa fa-map-pin"></i> {{$commune->district->nom_trans }}</a></li>
                @endif
                @if(isset($commune->autorite))
                    <li><a href="{{ url('autorite/'.$commune->autorite->id) }}"><i class="fa fa-map-pin"></i> {{ $commune->autorite->nom_trans }}</a></li>
                @endif
                <li class="active">{{ $commune->nom_trans }}</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <!--timeline start-->
            <section class="panel">
                <div class="panel-body text-center">

                    <p class="backmap"><a href="{{ url('/') }}"> <i class="fa fa-arrow-circle-left"></i>  &nbsp;{!! trans('carte.retour') !!}</a></p>

                    <?php $id        = (isset($commune->district) ? $commune->district->id : $commune->canton_id ); ?>
                    <?php $canton    = (isset($commune->district) ? $commune->canton_id : null); ?>
                    <?php $mapActive = (isset($commune->district) ? true : false); ?>

                    @include('frontend.partials.map',['id' => $id,'canton' => $canton, 'mapActive' => $mapActive])

                    {!! view('frontend/cantons/'.$commune->canton_id) !!}
                </div>
            </section>
            <!--timeline end-->
        </div>
    </div>

@stop