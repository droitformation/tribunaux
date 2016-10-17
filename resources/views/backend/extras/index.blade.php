@extends('backend.layouts.master')
@section('content')

    <div class="row"><!-- row -->
        <div class="col-md-6"><!-- col -->
            <p><a class="btn btn-default" href="{{ url('admin') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
        </div>
        <div class="col-md-6"><!-- col -->
            <div class="options text-right" style="margin-bottom: 10px;">
                <div class="btn-toolbar">
                    <a href="{{ url('admin/extra/create/'.$canton->id) }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary">
            <div class="panel-heading">Adresses pour {{ $canton->titre }}</div>
            <div class="panel-body">

                <table class="table" style="margin-bottom: 0px;">
                    <thead>
                    <tr>
                        <th class="col-sm-1">Action</th>
                        <th class="col-sm-2">Nom</th>
                        <th class="col-sm-1"></th>
                    </tr>
                    </thead>
                    <tbody class="selects">
                        @if(!$extras->isEmpty())
                            @foreach($extras as $level => $group)
                                <tr>
                                    <td colspan="3" bgcolor="#f5f5f5">
                                        <?php list($niveau,$id) = explode('-',$level);   ?>
                                        <strong>{{ $$niveau->find($id)->nom_trans or $$niveau->find($id)->titre_trans }}</strong>
                                    </td>
                                </tr>
                                @foreach($group as $extra)
                                    <tr>
                                        <td><a class="btn btn-sky btn-sm" href="{{ url('admin/extra/'.$extra->id) }}">&Eacute;diter</a></td>
                                        <td><strong>{{ $extra->titre }}</strong></td>
                                        <td class="text-right">
                                            <form action="{{ url('admin/extra/'.$extra->id) }}" method="POST" class="form-horizontal">
                                                <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                                <button data-action="{{ $extra->titre }}" class="btn btn-danger btn-sm deleteAction">x</button>
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