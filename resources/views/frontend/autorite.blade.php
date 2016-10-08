@extends('layouts.master')
@section('content')

    <?php $district = (isset($autorite->district) ? $autorite->district : null); ?>

    <h4 class="breadcrumbs">
        <a href="{{ url('canton/'.$autorite->canton->id) }}">{{ $autorite->canton->titre }}</a>
        {!! $district ? ' > <a href="'.url('district/'.$district->id).'">'.$district->nom_trans.'</a>' : '' !!}
        > {{ $autorite->nom_trans }}
    </h4>

    <section id="contenuCarte">

        <?php

            if(!$autorite->canton->extras->isEmpty())
            {
                $extras = $autorite->canton->extras;
            }

            if(isset($autorite->district) && !$autorite->district->extras->isEmpty())
            {
                $extras = $autorite->district->extras;
            }

            if(!$autorite->extras->isEmpty())
            {
                $extras = $autorite->extras;
            }

        ?>

        @include('frontend.partials.sidebar',
            [
                'canton_tribunaux'  => $autorite->canton->canton_tribunaux,
                'canton_donnees'    => $autorite->canton->canton_donnees,
                'tribunal_deuxieme' => $autorite->canton->tribunal_deuxieme,
                'tribunal_premier'  => $autorite->canton->tribunal_premier,
                'canton'   => $autorite->canton,
                'district' => $autorite->district,
                'autorite' => $autorite,
                'extras'   => (isset($extras) ? $extras : null)
            ]
        )

        <article class="carteInt">

            <?php $id        = (isset($autorite->district) ? $autorite->district->id : $autorite->canton_id ); ?>
            <?php $canton    = (isset($autorite->district) ? $autorite->canton_id : null); ?>
            <?php $mapActive = (isset($autorite->district) ? true : false); ?>

            @include('frontend.partials.map',['id' => $id, 'canton' => $canton, 'mapActive' => $mapActive])

            {!! view('frontend/cantons/'.$autorite->canton_id) !!}

        </article>
    </section>

@stop