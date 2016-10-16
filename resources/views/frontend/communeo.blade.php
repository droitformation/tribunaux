@extends('layouts.master')
@section('content')

<?php
    $district = (isset($commune->district) ? $commune->district : null);
    $autorite = (isset($commune->autorite) ? $commune->autorite : null);
?>

<div class="row">
    <h4 class="breadcrumbs col-md-12">
        <a href="{{ url('canton/'.$commune->canton->id) }}">{{ $commune->canton->titre }}</a>
        {!! $district ? ' > <a href="'.url('district/'.$district->id).'">'.$district->nom_trans.'</a>' : '' !!}
        {!! $autorite ? ' > <a href="'.url('autorite/'.$autorite->id).'">'.$autorite->nom_trans.'</a>' : '' !!}
        > {{ $commune->nom_trans }}
    </h4>
</div>

<section class="row">
    @include('frontend.partials.sidebar',
        [
            'canton_tribunaux'  => $commune->canton->canton_tribunaux,
            'canton_donnees'    => $commune->canton->canton_donnees,
            'tribunal_deuxieme' => $commune->canton->tribunal_deuxieme,
            'tribunal_premier'  => $commune->canton->tribunal_premier,
            'canton'            => $commune->canton,
            'district'          => $district,
            'autorite'          => $autorite,
        ]
    )

    <article class="col-md-8">

        <p class="backmap"><a href="{{ url('/') }}"> <i class="fa fa-arrow-circle-left"></i>  &nbsp;{!! trans('carte.retour') !!}</a></p>

        <?php $id        = (isset($commune->district) ? $commune->district->id : $commune->canton_id ); ?>
        <?php $canton    = (isset($commune->district) ? $commune->canton_id : null); ?>
        <?php $mapActive = (isset($commune->district) ? true : false); ?>

        @include('frontend.partials.map',['id' => $id,'canton' => $canton, 'mapActive' => $mapActive])

        {!! view('frontend/cantons/'.$commune->canton_id) !!}

    </article>
</section>


@stop