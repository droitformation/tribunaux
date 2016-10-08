@extends('layouts.master')
@section('content')

    <h4 class="breadcrumbs">
        <a href="{{ url('canton/'.$district->canton->id) }}">{{ $district->canton->titre }}</a> > {{ $district->nom_trans }}
    </h4>

    <section id="contenuCarte">

        <?php

            if(!$district->canton->extras->isEmpty())
            {
                $extras = $district->canton->extras;
            }

            if(!$district->extras->isEmpty())
            {
                $extras = $district->extras;
            }

        ?>

        @include('frontend.partials.sidebar',
            [
                'canton_tribunaux'  => $district->canton->canton_tribunaux,
                'canton_donnees'    => $district->canton->canton_donnees,
                'tribunal_deuxieme' => $district->canton->tribunal_deuxieme,
                'tribunal_premier'  => $district->canton->tribunal_premier,
                'canton'   => $district->canton,
                'district' => $district,
                'extras'   => (isset($extras) ? $extras : null)
            ]
        )

        <article class="carteInt">

            <div class="rechercheNiveau">
                @if(!$district->autorites->isEmpty())
                    @include('frontend.partials.autorites',['autorites' => $district->autorites])
                @endif
            </div>

            @include('frontend.partials.map',['id' => $district->id,'canton' => $district->canton_id, 'mapActive' => true])

            {!! view('frontend/cantons/'.$district->canton_id) !!}

        </article>
    </section>

@stop