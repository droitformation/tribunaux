@extends('backend.layouts.master')
@section('content')

    <div class="row"><!-- row -->
        <div class="col-md-6"><!-- col -->
            <p><a class="btn btn-default" href="{{ url('admin') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
        </div>
        <div class="col-md-6"><!-- col -->
            <div class="options text-right" style="margin-bottom: 10px;">
                <div class="btn-toolbar">
                    <a href="{{ url('admin/district/create/'.$level.'/'.$canton->id) }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary">
            <div class="panel-heading">District {{ $canton->titre }}</div>
            <div class="panel-body">

                <table class="table" style="margin-bottom: 0px;" id="">
                    <thead>
                    <tr>
                        <th class="col-sm-1">Action</th>
                        <th class="col-sm-2">Nom</th>
                        <th class="col-sm-2">Tribunal</th>
                        <th class="col-sm-1">Autorités</th>
                        <th class="col-sm-1"></th>
                    </tr>
                    </thead>
                    <tbody class="selects">
                        @if(!empty($districts))
                            @foreach($districts as $district)
                                <tr>
                                    <td><a class="btn btn-sky btn-sm" href="{{ url('admin/district/'.$level.'/'.$district->id) }}">&Eacute;diter</a></td>
                                    <td><strong>{{ $district->nom }}</strong></td>
                                    <td>{!! $district->tribunal !!}</td>
                                    <td>
                                        @if(!$district->autorites->isEmpty())
                                            <a class="btn btn-green btn-sm" href="{{ url('admin/autorites/district/'.$district->id) }}">&Eacute;diter autorités</a>
                                        @else
                                            <a class="btn btn-default btn-sm" href="{{ url('admin/autorite/create/district/'.$district->id) }}">Ajouter</a>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <form action="{{ url('admin/district/'.$district->id) }}" method="POST" class="form-horizontal">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {!! csrf_field() !!}
                                            <button data-action="{{ $district->nom }}" class="btn btn-danger btn-sm deleteAction">x</button>
                                        </form>
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