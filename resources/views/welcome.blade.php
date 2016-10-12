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
    <div class="col-lg-3">
        <h2>Recherche par canton</h2>
        <section class="panel">
            <div class="panel-body">
                <form action="{{ url('search') }}" method="post" class="EnvoiDonnees">{!! csrf_field() !!}
                    <select data-placeholder="{!! trans('carte.choix_canton') !!}" class="chzn-select" style="width:100%;" tabindex="2" name="search">
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
    <div class="col-lg-9">
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