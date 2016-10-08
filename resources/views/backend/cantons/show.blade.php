@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p class="pull-left"><a class="btn btn-default" href="{{ url('admin') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>

<!-- start row -->
<div class="row">

    @if (!empty($canton) )

    <div class="col-md-7">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form data-validate-parsley action="{{ url('admin/canton/'.$canton->id) }}" method="POST" class="form-horizontal" >
                <input type="hidden" name="_method" value="PUT">
                {!! csrf_field() !!}

                <div class="panel-heading"><h4>&Eacute;diter </h4></div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Titre</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" disabled class="form-control" name="titre" placeholder="{{ $canton->titre }}">
                                <span class="input-group-addon">fr</span>
                            </div><br/>
                            <div class="input-group">
                                <input type="text" disabled class="form-control" name="titre_de" placeholder="{{ $canton->titre_de }}">
                                <span class="input-group-addon">all</span>
                            </div>
                        </div>
                    </div>

                    <hr/>
                    <h4>Tribunaux 1ère et 2ème instance</h4><br/>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Tribunal de 2ème instance</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" value="{{ $canton->tribunal_deuxieme->titre }}" class="form-control" name="tribunal_deuxieme[titre]" placeholder="">
                                <span class="input-group-addon">fr</span>
                            </div><br/>
                            <div class="input-group">
                                <input type="text" value="{{ $canton->tribunal_deuxieme->titre_de }}" class="form-control" name="tribunal_deuxieme[titre_de]" placeholder="">
                                <span class="input-group-addon">all</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Adresse</label>
                        <div class="col-sm-8">
                            {!! Form::textarea('deuxieme',$canton->canton_tribunaux->deuxieme, array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6' )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Tribunal de 1ère instance</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" value="{{ $canton->tribunal_premier->titre }}" class="form-control" name="tribunal_premier[titre]" placeholder="">
                                <span class="input-group-addon">fr</span>
                            </div><br/>
                            <div class="input-group">
                                <input type="text" value="{{ $canton->tribunal_premier->titre_de }}" class="form-control" name="tribunal_premier[titre_de]" placeholder="">
                                <span class="input-group-addon">all</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Adresse</label>
                        <div class="col-sm-8">
                            {!! Form::textarea('premier',$canton->canton_tribunaux->premier, array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6' )) !!}
                        </div>
                    </div>

                    <hr/>

                    <h4>Siège de l'autorité de conciliation ou juge de paix <small>tout le canton</small></h4>
                    <p class="text-warning">
                        Dans les cas des adresses du tribunal de première instance et de l'autorité de conciliation, lorsque le champs de l'adresse est renseigné dans les informations du canton, celles-ci comptent pour tout le canton.
                    </p><br/>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Lien ou adresse</label>
                        <div class="col-sm-8">
                            {!! Form::textarea('siege', $canton->canton_tribunaux->siege , ['class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6']) !!}
                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer ">
                    <div class="col-sm-3">
                        {!! Form::hidden('tribunal_premier[id]',  $canton->tribunal_premier->id ) !!}
                        {!! Form::hidden('tribunal_deuxieme[id]', $canton->tribunal_deuxieme->id ) !!}
                        {!! Form::hidden('tribunal_premier[level]','tribunal_premier') !!}
                        {!! Form::hidden('tribunal_deuxieme[level]','tribunal_deuxieme') !!}
                        {!! Form::hidden('id', $canton->canton_tribunaux->id ) !!}
                    </div>
                    <div class="col-sm-8 text-right">
                        <button class="btn btn-primary" type="submit">Envoyer </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @endif

    <div class="col-md-5">
        <div class="panel panel-midnightblue">
            <div class="panel-heading"><h4>Remarques pour le canton</h4></div>
            <div class="panel-body">
               <p class="text-right"><a class="btn btn-success btn-sm" href="{{ url('admin/donnee/create/'.$canton->id) }}"><i class="fa fa-plus"></i> &nbsp;Ajouter</a></p>
                <!-- Données générales pour toute le canton -->
                @if(isset($canton->canton_donnees) && !$canton->canton_donnees->isEmpty())
                    <ul style="margin-top: 5px;" class="list-group" id="sortable">
                        @foreach($canton->canton_donnees as $donnees)
                            <li style="cursor: grabbing;" class="list-group-item" id="rang_{{ $donnees->id }}">
                               {{ $donnees->titre }}
                                <div class="btn-group pull-right">
                                    <form action="{{ url('admin/donnee/'.$donnees->id) }}" method="POST" class="form-horizontal">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {!! csrf_field() !!}
                                        <a href="{{ url('admin/donnee/'.$donnees->id) }}" class="btn btn-info btn-sm">&Eacute;diter</a>
                                        <button data-what="Remarque" data-action="{{ $donnees->titre }}" class="btn btn-danger btn-sm deleteAction">x</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </div>
</div>
<!-- end row -->


@stop