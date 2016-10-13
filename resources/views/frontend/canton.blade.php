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
        <h4 class="breadcrumbs col-md-12"><a href="">{{ $canton->titre }}</a></h4>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-3 col-xs-12">
            <section class="panel">
                <div class="panel-body">
                    @if(!$canton->districts->isEmpty())
                        @include('frontend.partials.districts',['districts' => $canton->districts])
                    @endif
                </div>
            </section>
        </div>
        <div class="col-lg-8 col-md-9 col-xs-12">
            <!--timeline start-->
            <section class="panel">
                <div class="panel-body text-center">
                    @include('frontend.partials.map',['id' => $canton->id])

                    {!! view('frontend/cantons/'.$canton->id) !!}
                </div>
            </section>
            <!--timeline end-->
        </div>
    </div>

@stop