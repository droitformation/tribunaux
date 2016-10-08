@extends('backend.layouts.master')
@section('content')

    <div class="row"><!-- row -->
        <div class="col-md-6"><!-- col -->
            <p><a class="btn btn-default" href="{{ url('admin') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
        </div>
        <div class="col-md-6"><!-- col -->
            <div class="options text-right" style="margin-bottom: 10px;">
                <div class="btn-toolbar">
                    <a href="{{ url('admin/menu/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary">
            <div class="panel-heading">Liens du menu</div>
            <div class="panel-body">


                    <ul class="list-group" id="sortable2">
                        @if(!empty($menus))
                            @foreach($menus as $menu)
                                <li class="list-group-item" id="rang_{{ $menu->id }}">
                                    <div class="row">
                                        <div class="col-md-2"><a class="btn btn-sky btn-sm" href="{{ url('admin/menu/'.$menu->id) }}">&Eacute;diter</a></div>
                                        <div class="col-md-1">Ordre: {{ $menu->rang }}</div>
                                        <div class="col-md-6"><strong>{{ $menu->titre }}</strong></div>
                                        <div class="col-md-3 text-right">
                                            <form action="{{ url('admin/menu/'.$menu->id) }}" method="POST" class="form-horizontal">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {!! csrf_field() !!}
                                                <button data-action="Mots: {{ $menu->titre }}" class="btn btn-danger btn-sm deleteAction">x</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif

                    </ul>


            </div>
        </div>

    </div>
</div>

@stop