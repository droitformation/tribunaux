@extends('layouts.new')
@section('content')
<!--state overview start-->
<div class="row state-overview">
    <div class="col-lg-12 col-sm-12">
        <h2>{!! trans('carte.search_commune') !!}</h2>
        <section class="panel" id="recherche">
            @include('frontend.partials.communes')
        </section>
    </div>
</div>
<!--state overview end-->

<div class="row">
    <div class="col-lg-3 col-md-4 col-xs-12">
        <h2>Recherche par canton</h2>
        <section class="panel">
            <div class="panel-body">
                <form action="{{ url('search') }}" method="post" class="EnvoiDonnees">{!! csrf_field() !!}
                    <select class="canton-select" tabindex="2" data-placeholder="{!! trans('carte.choix_canton') !!}" style="width: 100%;">
                        <option value=""></option>
                        @if(!$cantons->isEmpty())
                            @foreach($cantons as $canton)
                                <option value="canton-{{ $canton->id }}">{{ $canton->titre_trans }}</option>
                            @endforeach
                        @endif
                    </select>
                </form>
            </div>
        </section>
    </div>
    <div class="col-lg-9 col-md-8 col-xs-12">
        <!--timeline start-->
        <section class="panel">
            <div class="panel-body">
                @if(!$tribunaux->isEmpty())
                    @foreach($tribunaux as $tribunal)
                        <div id="{{ $tribunal->slug }}"><a href="{{ url('tribunal/'. $tribunal->id) }}" class="selector" title="{{ $tribunal->titre_trans }}"></a></div>
                    @endforeach
                @endif

                @include('frontend.partials.suisse')
            </div>
        </section>
        <!--timeline end-->
    </div>
</div>

@stop