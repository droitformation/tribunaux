@extends('backend.layouts.master')
@section('content')

    <div class="row"><!-- row -->
        <div class="col-md-6"><!-- col -->
            <p><a class="btn btn-default" href="{{ url('admin') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
        </div>
        <div class="col-md-6"><!-- col -->
            <div class="options text-right" style="margin-bottom: 10px;">
                <div class="btn-toolbar">
                    <a href="{{ url('admin/commune/create/'.$canton->id) }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary">
            <div class="panel-heading">Communes {{ $canton->titre }}</div>
            <div class="panel-body">

                <table class="table" style="margin-bottom: 0px;" id="">
                    <thead>
                    <tr>
                        <th style="width: 20px !important;"></th>
                        <th style="width: 20px !important;"></th>
                        <th class="col-md-2">Action</th>
                        <th class="col-md-4">Nom</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="selects">
                        @if(!$canton->communes->isEmpty())

                            <?php $grouped = group_communes($canton->communes); ?>

                            @foreach($grouped as $district => $autorites)

                                @if(!is_numeric($district))
                                    <tr style="background: #f3f3f3;"><td colspan="5"><h5 style="padding: 0 5px; margin: 0;"><strong>{{ $district }}</strong></h5></td></tr>
                                @endif

                                @foreach($autorites as $autorite => $communes)

                                    @if(!is_numeric($autorite))
                                        <tr style="background: #eff4ff;">
                                            <td></td>
                                            <td colspan="4"><h5 style="padding: 0 5px; margin: 0;"><strong>{{ $autorite }}</strong></h5></td>
                                        </tr>
                                    @endif

                                    @foreach($communes as $commune)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><a class="btn btn-sky btn-sm" href="{{ url('admin/commune/'.$commune->id) }}">&Eacute;diter</a></td>
                                            <td><strong>{{ $commune->nom }}</strong></td>
                                            <td class="text-right">
                                                <form action="{{ url('admin/commune/'.$commune->id) }}" method="POST" class="form-horizontal">
                                                    <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                                    <button data-action="Mots: {{ $commune->nom }}" class="btn btn-danger btn-sm deleteAction">x</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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