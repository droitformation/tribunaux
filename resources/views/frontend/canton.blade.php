@extends('layouts.master')
@section('content')

<div class="row">
    <h4 class="breadcrumbs col-md-12"><a href="">{{ $canton->titre }}</a></h4>
</div>
<section class="row">

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

    <article class="col-md-8">

        @if(!$canton->districts->isEmpty())
            @include('frontend.partials.districts',['districts' => $canton->districts])
        @endif

        @include('frontend.partials.map',['id' => $canton->id])

        {!! view('frontend/cantons/'.$canton->id) !!}
    </article>
</section>

@include('frontend.partials.tabs', ['canton_donnees' => $canton->canton_donnees])

@stop