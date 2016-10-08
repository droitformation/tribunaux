@extends('layouts.master')
@section('content')

    <h4><a href="">{{ $canton->titre }}</a></h4>

    <section id="contenuCarte">
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

        <article class="carteInt">

            <div class="rechercheNiveau">
                @if(!$canton->districts->isEmpty())
                    @include('frontend.partials.districts',['districts' => $canton->districts])
                @endif
            </div>

            @include('frontend.partials.map',['id' => $canton->id])

            {!! view('frontend/cantons/'.$canton->id) !!}

        </article>
    </section>

@stop