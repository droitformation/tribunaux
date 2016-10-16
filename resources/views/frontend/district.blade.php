@extends('layouts.master')

@section('sidebar')

    <?php
    if(!$district->canton->extras->isEmpty()) {
        $extras = $district->canton->extras;
    }

    if(!$district->extras->isEmpty()) {
        $extras = $district->extras;
    }
    ?>

    @include('frontend.partials.sidebar',
       [
            'canton_tribunaux'  => $canton->canton_tribunaux,
            'canton_donnees'    => $canton->canton_donnees,
            'tribunal_deuxieme' => $canton->tribunal_deuxieme,
            'tribunal_premier'  => $canton->tribunal_premier,
            'canton'            => $canton,
            'extras'            => (!$canton->extras->isEmpty() ? $canton->extras : null)
        ]
    )

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ url('canton/'.$canton->id) }}"><i class="fa fa-arrow-circle-o-right"></i> {{ $canton->titre_trans }}</a></li>
                <li class="active">{{ $district->nom_trans }}</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-3 col-xs-12">
            <section class="panel">
                <div class="panel-body">
                    @if(!$district->autorites->isEmpty())
                        @include('frontend.partials.autorites',['dautorites' => $district->autorites])
                    @endif
                </div>
            </section>
        </div>
        <div class="col-lg-8 col-md-9 col-xs-12">
            <!--timeline start-->
            <section class="panel">
                <div class="panel-body text-center">

                    <p class="backmap"><a href="{{ url('/') }}"> <i class="fa fa-arrow-circle-left"></i> &nbsp;{!! trans('carte.retour') !!}</a></p>

                    @include('frontend.partials.map',['id' => $district->id,'canton' => $district->canton_id, 'mapActive' => true])

                    {!! view('frontend/cantons/'.$district->canton_id) !!}
                </div>
            </section>
            <!--timeline end-->
        </div>
    </div>

@stop