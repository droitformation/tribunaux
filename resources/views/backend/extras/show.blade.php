@extends('backend.layouts.master')
@section('content')

    <div class="row"><!-- row -->
        <div class="col-md-12"><!-- col -->
            <p><a class="btn btn-default" href="{{ url('admin/extra/canton/'.$canton->id) }}"><i class="fa fa-reply"></i> &nbsp;Retour au canton</a></p>
        </div>
    </div>
    <!-- start row -->
    <div class="row">

        <div class="col-md-7">
            <div class="panel panel-midnightblue">

                <!-- form start -->
                <form data-validate-parsley action="{{ url('admin/extra/'.$extra->id) }}" method="POST" class="form-horizontal" >
                    <input type="hidden" name="_method" value="PUT">
                    {!! csrf_field() !!}

                    <div class="panel-heading"><h4>&Eacute;diter la remarque {{ $canton->titre }}</h4></div>
                    <div class="panel-body event-info">

                        <input type="hidden" name="canton_id" value="{{ $canton->id }}">
                        <input type="hidden" name="id" value="{{ $extra->id }}">

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Rang</label>
                            <div class="col-sm-3">
                                <input type="text" value="{{ $extra->rang }}" class="form-control" name="rang">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label"><strong>Français</strong></label>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Titre</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" value="{{ $extra->titre }}" class="form-control" name="titre" placeholder="">
                                    <span class="input-group-addon">fr</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Contenu</label>
                            <div class="col-sm-8">
                                {!! Form::textarea('contenu', $extra->contenu , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '3' )) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label"><strong>Allemand</strong></label>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Titre</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" value="{{ $extra->titre_de }}" class="form-control" name="titre_de" placeholder="">
                                    <span class="input-group-addon">all</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Contenu</label>
                            <div class="col-sm-8">
                                {!! Form::textarea('contenu_de',  $extra->contenu_de , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '3' )) !!}
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer mini-footer ">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-8">
                            <button class="btn btn-primary" type="submit">Envoyer</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-midnightblue">
                <div class="panel-heading"><h4>Relation pour l'adresse</h4></div>
                <div class="panel-body">
                    <p class="text-right">
                        <a class="btn btn-success" role="button" data-toggle="collapse" href="#addRelation"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
                    </p>
                    <div class="collapse" id="addRelation">
                        <div class="well">
                            <form action="{{ url('admin/extra/relation') }}" method="POST" class="form-horizontal">{!! csrf_field() !!}
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input name="relation[canton_id]" value="{{ $extra->canton_id }}" type="checkbox"> <strong>Lier à tout le Canton</strong>
                                        </label>
                                    </div>
                                </div>
                                <p class="oubien">ou</p>
                                @if(!$canton->districts->isEmpty())
                                    <div class="form-group">
                                        <label><strong>District</strong></label>
                                        <select name="relation[district_id]" class="form-control">
                                            <option value="">Choisir</option>
                                            @foreach($canton->districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->nom_trans }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="oubien">ou</p>
                                @endif
                                @if(!$canton->autorites->isEmpty())
                                    <div class="form-group">
                                        <label><strong>Autorité</strong></label>
                                        <select name="relation[autorite_id]" class="form-control">
                                            <option value="">Choisir</option>
                                            @foreach($canton->autorites as $autorite)
                                                <option value="{{ $autorite->id }}">{{ $autorite->nom_trans }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <input type="hidden" name="id" value="{{ $extra->id }}">
                                <p class="text-right"><button class="btn btn-primary">Ajouter</button></p>
                            </form>
                        </div>
                    </div>

                    <ul class="list-group" style="margin-top: 5px;">

                        @if(!$extra->canton->isEmpty())
                            @foreach($extra->canton as $canton)
                                <li class="list-group-item">Pour tout le canton
                                    <div class="pull-right">
                                        <form action="{{ url('admin/extra/relation/'.$canton->pivot->id) }}" method="POST" class="form-horizontal">
                                            <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                            <input type="hidden" name="model" value="canton">
                                            <input type="hidden" name="id" value="{{ $canton->id }}">
                                            <button data-what="Relation" data-action="Canton" class="btn btn-danger btn-sm deleteAction">x</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                        @if(!$extra->district->isEmpty())
                            @foreach($extra->district as $district)
                                <li class="list-group-item">{{ $district->nom }}
                                    <div class="pull-right">
                                        <form action="{{ url('admin/extra/relation/'.$district->pivot->id) }}" method="POST" class="form-horizontal">
                                            <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                            <input type="hidden" name="id" value="{{ $district->id }}">
                                            <input type="hidden" name="model" value="district">
                                            <button data-what="Relation" data-action="{{ $district->nom }}" class="btn btn-danger btn-sm deleteAction">x</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                        @if(!$extra->autorite->isEmpty())
                            @foreach($extra->autorite as $autorite)
                                <li class="list-group-item">{{ $autorite->nom }}
                                    <div class="pull-right">
                                        <form action="{{ url('admin/extra/relation/'.$autorite->pivot->id) }}" method="POST" class="form-horizontal">
                                            <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                            <input type="hidden" name="model_id" value="{{ $autorite->id }}">
                                            <input type="hidden" name="model" value="autorite">
                                            <button data-what="Relation" data-action="{{ $autorite->nom }}" class="btn btn-danger btn-sm deleteAction">x</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@stop