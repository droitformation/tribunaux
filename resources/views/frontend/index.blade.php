@extends('layouts.master')
@section('content')

    <div id="contenu" role="main">

        <h2 class="outil">{!! trans('carte.titre') !!}</h2>
        <h2><strong>{!! trans('carte.search_commune') !!}</strong></h2>
        <div id="recherche">
            <p class="ajaxloader"><img src="{{ asset('images/ajax-loader.gif') }}" alt="" /></p>
        </div>

        <hr/>

        <h2><strong>{!! trans('carte.search_canton') !!}</strong></h2>
        <section id="contenuCarte">

            <article id="rechercheSuisse">
                <form action="{{ url('search') }}" method="post" class="EnvoiDonnees">
                    {!! csrf_field() !!}
                    <select data-placeholder="{!! trans('carte.choix_canton') !!}" class="chzn-select" style="width:250px;" tabindex="2" name="search">
                        <option value=""></option>
                        @if(!$cantons->isEmpty())
                            @foreach($cantons as $canton)
                                <option value="canton-{{ $canton->id }}">{{ $canton->titre_trans }}</option>
                            @endforeach
                        @endif
                    </select>
                </form>
            </article>

            <article id="Carte">

                @if(!$tribunaux->isEmpty())
                    @foreach($tribunaux as $tribunal)
                        <div id="{{ $tribunal->slug }}"><a href="{{ url('tribunal/'. $tribunal->id) }}" class="selector" title="{{ $tribunal->titre_trans }}"></a></div>
                    @endforeach
                @endif

                @include('frontend.partials.suisse')

                <div style="clear:both;"></div>
            </article>

        </section>
    </div>

@stop