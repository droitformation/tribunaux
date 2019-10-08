@extends('layouts.new')
@section('sidebar')
    @if(!$menus->isEmpty() && Request::is('new'))
        <?php
        $about = $menus->first(function ($value, $key) {
            return $value->link == 'about';
        });
        ?>
        @if($about)
            <li class="sub-menu">
                <a class="sublink active" href="javascript:;"><i class="fa fa-home"></i><span>{{ $about->titre_trans }}</span></a>
                <ul class="sub">
                    <li class="{{ $about->link }}">{!! $about->contenu_trans !!}</li>
                </ul>
            </li>
        @endif
    @endif
@stop

@section('content')

    @include('frontend.parts.list-communes')

    <div class="row">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <h2>{!! trans('carte.search_canton') !!}</h2>
            <section class="panel">
                <div class="panel-body">
                    <form action="{{ url('search') }}" method="post" class="EnvoiDonnees">{!! csrf_field() !!}
                        <select class="canton-select" name="search" tabindex="2" data-placeholder="{!! trans('carte.choix_canton') !!}" style="width: 100%;">
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

            <div class="panel">
                <div class="panel-body">
                    @if(!$tribunaux->isEmpty())
                        @foreach($tribunaux as $tribunal)
                            <div id="{{ $tribunal->slug }}"><a href="{{ url('tribunal/'. $tribunal->id) }}" class="selector" title="{{ $tribunal->titre_trans }}"></a></div>
                        @endforeach
                    @endif

                    @include('frontend.parts.suisse')
                </div>
            </div>
        </div>
    </div>

@stop