@extends('backend.layouts.master')
@section('content')

    <div class="row"><!-- row -->
        <div class="col-md-12"><!-- col -->
            <p><a class="btn btn-default" href="{{ url('admin/canton/'.$donnee->canton->first()->id) }}"><i class="fa fa-reply"></i> &nbsp;Retour au canton</a></p>
        </div>
    </div>
    <!-- start row -->
    <div class="row">

        <div class="col-md-10">
            <div class="panel panel-midnightblue">

                <!-- form start -->
                <form data-validate-parsley action="{{ url('admin/donnee/'.$donnee->id) }}" method="POST" class="form-horizontal" >
                    <input type="hidden" name="_method" value="PUT">
                    {!! csrf_field() !!}

                    <div class="panel-heading"><h4>&Eacute;diter la remarque {{ $donnee->canton->first()->titre }}</h4></div>
                    <div class="panel-body event-info">

                        <input type="hidden" name="canton_id" value="{{ $donnee->canton->first()->id }}">
                        <input type="hidden" name="id" value="{{ $donnee->id }}">

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Rang</label>
                            <div class="col-sm-3">
                                <input type="text" value="{{ $donnee->rang }}" class="form-control" name="rang">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Annoncer</label>
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label>
                                        <input name="advertise" value="1" {{ $donnee->advertise ? 'checked' : '' }} type="checkbox">
                                        <strong>Informations pour niveau inférieur</strong>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label"><strong>Français</strong></label>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Titre</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" value="{{ $donnee->titre }}" class="form-control" name="titre" placeholder="">
                                    <span class="input-group-addon">fr</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Contenu</label>
                            <div class="col-sm-6">
                                {!! Form::textarea('contenu', $donnee->contenu , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '3' )) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label"><strong>Allemand</strong></label>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Titre</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" value="{{ $donnee->titre_de }}" class="form-control" name="titre_de" placeholder="">
                                    <span class="input-group-addon">all</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Contenu</label>
                            <div class="col-sm-6">
                                {!! Form::textarea('contenu_de',  $donnee->contenu_de , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '3' )) !!}
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer mini-footer ">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <button class="btn btn-primary" type="submit">Envoyer</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <!-- end row -->

@stop