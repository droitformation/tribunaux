@extends('backend.layouts.master')
@section('content')

    <div class="row">

        <div class="col-md-12">
            <h3>Cantons</h3>
            <div class="panel panel-midnightblue">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="col-sm-4">Nom</th>
                            <th class="col-sm-1">Infos tout canton</th>
                            <th class="col-sm-1">Régions</th>
                            <th class="col-sm-1">Autorités</th>
                            <th class="col-sm-1">Communes</th>
                            <th class="col-sm-1">Autre adresses</th>
                        </tr>
                        </thead>
                        <tbody class="selects">
                            @if(!empty($cantons))
                                @foreach($cantons as $canton)
                                    <tr>
                                        <td><strong>{{ $canton->titre }}</strong></td>
                                        <td><a class="btn btn-primary btn-sm" href="{{ url('admin/canton/'.$canton->id) }}">&Eacute;diter</a></td>
                                        <td>
                                            @if(!$canton->districts->isEmpty())
                                                <a class="btn btn-warning btn-sm" href="{{ url('admin/districts/canton/'.$canton->id) }}">&Eacute;diter</a>
                                            @else
                                                <a class="btn btn-default btn-sm" href="{{ url('admin/district/create/canton/'.$canton->id) }}">Ajouter</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$canton->autorites->isEmpty())
                                                <a class="btn btn-green btn-sm" href="{{ url('admin/autorites/canton/'.$canton->id) }}">&Eacute;diter</a>
                                            @else
                                                <a class="btn btn-default btn-sm" href="{{ url('admin/autorite/create/canton/'.$canton->id) }}">Ajouter</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$canton->communes->isEmpty())
                                                <a class="btn btn-green btn-sm" href="{{ url('admin/communes/canton/'.$canton->id) }}">&Eacute;diter</a>
                                            @else
                                                <a class="btn btn-default btn-sm" href="{{ url('admin/commune/create/canton/'.$canton->id) }}">Ajouter</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-default btn-sm" href="{{ url('admin/extra/canton/'.$canton->id) }}">Liste</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@stop