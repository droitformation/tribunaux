@extends('backend.layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Utilisateurs</h3>
        </div>
        <div class="col-md-3 text-right">
            <a href="{{ url('admin/user/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
        </div>
    </div>

    <div class="row">
    <div class="col-md-8 col-xs-12">

        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="generic">
                        <thead>
                        <tr>
                            <th class="col-sm-1">Action</th>
                            <th class="col-sm-4">Nom</th>
                            <th class="col-sm-3">Email</th>
                            <th class="col-sm-2"></th>
                        </tr>
                        </thead>
                        <tbody class="selects">

                        @if(!empty($users))
                            @foreach($users as $user)
                            <tr>
                                <td><a class="btn btn-sky btn-sm" href="{{ url('admin/user/'.$user->id) }}">&Eacute;diter</a></td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td><strong>{{ $user->email }}</strong></td>
                                <td class="text-right">
                                    <form action="{{ url('admin/user/'.$user->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                        <button data-action="{{ $user->name }}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
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
</div>

@stop