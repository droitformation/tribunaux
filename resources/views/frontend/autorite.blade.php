@extends('layouts.new')
@section('sidebar')

    <?php
        $extras = collect([]);

        $extras = $extras->merge($autorite->extras);

        if(isset($autorite->district)) {
            $extras = $extras->merge($autorite->district->extras);
        }

        $extras = $extras->merge($canton->adresses);
        $extras = $extras->unique('id');
    ?>

    @include('frontend.partials.sidebar',
        [
            'canton_tribunaux'  => $canton->canton_tribunaux,
            'canton_donnees'    => $canton->canton_donnees->where('advertise',null),
            'tribunal_deuxieme' => $canton->tribunal_deuxieme,
            'tribunal_premier'  => $canton->tribunal_premier,
            'canton'   => $canton,
            'district' => $autorite->district,
            'autorite' => $autorite,
            'extras'   => $extras
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

                    <?php $id     = (isset($autorite->district) ? $autorite->district->id : $autorite->id ); ?>
                    <?php $canton = (isset($autorite->district) ? $autorite->canton_id : null); ?>

                    @include('frontend.partials.map',['id' => $id,'canton' => $autorite->canton_id, 'mapActive' => true, 'titles' => $titles])

                    {!! view('frontend/cantons/'.$autorite->canton_id) !!}
                </div>
            </section>
            <!--timeline end-->
        </div>
    </div>

@stop