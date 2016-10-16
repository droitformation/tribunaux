@extends('layouts.master')

@section('sidebar')

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
                <li class="active">{{ $canton->titre_trans }}</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-3 col-xs-12">
            <section class="panel">
                <div class="panel-body">
                    @if(!$canton->districts->isEmpty())
                        @include('frontend.partials.districts',['cdistricts' => $canton->districts])
                    @endif
                </div>
            </section>
        </div>
        <div class="col-lg-8 col-md-9 col-xs-12">
            <!--timeline start-->
            <section class="panel">
                <div class="panel-body text-center">

                    <p class="backmap"><a href="{{ url('/') }}"> <i class="fa fa-arrow-circle-left"></i>  &nbsp;{!! trans('carte.retour') !!}</a></p>

                    @include('frontend.partials.map',['id' => $canton->id])

                    {!! view('frontend/cantons/'.$canton->id) !!}
                </div>
            </section>
            <!--timeline end-->
        </div>
    </div>

@stop