@extends('backend.layouts.master')
@section('content')

    <div class="row"><!-- row -->
        <div class="col-md-6"><!-- col -->
            <p><a class="btn btn-default" href="{{ url('admin') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
        </div>
        <div class="col-md-6"><!-- col -->
            <div class="options text-right" style="margin-bottom: 10px;">
                <div class="btn-toolbar">
                    <a href="{{ url('admin/autorite/create/'.$canton->id) }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary">
            <div class="panel-heading">Autorités {{ $canton->titre }}</div>
            <div class="panel-body">

                <table class="table" style="margin-bottom: 0px;" id="">
                    <thead>
                    <tr>
                        <th class="col-sm-1">Action</th>
                        <th class="col-sm-2">Nom</th>
                        <th class="col-sm-2">Siège</th>
                        <th class="col-sm-1">Communes</th>
                        <th class="col-sm-1">Tout le canton</th>
                        <th class="col-sm-1"></th>
                    </tr>
                    </thead>
                    <tbody class="selects">

                        @if(!$canton->autorites->isEmpty())

                            <?php
                                $grouped = $canton->autorites->groupBy(function ($autorite, $key) {
                                    return isset($autorite->district) ? $autorite->district->nom : '';
                                });
                            ?>

                            @foreach($grouped as $dis => $group)
                                <tr style="background: #f3f3f3;"><td colspan="6"><h5><strong>{{ $dis }}</strong></h5></td></tr>
                                @foreach($group as $autorite)
                                    <tr>
                                        <td><a class="btn btn-sky btn-sm" href="{{ url('admin/autorite/'.$autorite->id) }}">&Eacute;diter</a></td>
                                        <td><strong>{{ $autorite->nom }}</strong></td>
                                        <td>{!! $autorite->siege !!}</td>
                                        <td>
                                            @if(!$autorite->communes->isEmpty())
                                                <a class="btn btn-green btn-sm" href="{{ url('admin/communes/canton/'.$canton->id) }}">&Eacute;diter</a>
                                            @else
                                                <a class="btn btn-default btn-sm" href="{{ url('admin/commune/create/'.$canton->id) }}">Ajouter</a>
                                            @endif
                                        </td>
                                        <td>{!! $autorite->district_id == 0 ? '<span class="label label-info">Oui</span>' : '' !!}</td>
                                        <td class="text-right">
                                            <form action="{{ url('admin/autorite/'.$autorite->id) }}" method="POST" class="form-horizontal">
                                                <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                                <button data-action="Mots: {{ $autorite->nom }}" class="btn btn-danger btn-sm deleteAction">x</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif

                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>

@stop