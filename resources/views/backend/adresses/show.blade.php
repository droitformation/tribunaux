@extends('backend.layouts.master')
@section('content')

    <div class="row"><!-- row -->
        <div class="col-md-12"><!-- col -->
            <p><a class="btn btn-default" href="{{ url('admin/tribunaux/'.$adresse->tribunal_id) }}"><i class="fa fa-reply"></i> &nbsp;Retour au tribunal</a></p>
        </div>
    </div>
    <!-- start row -->
    <div class="row">

        <div class="col-md-10">
            <div class="panel panel-midnightblue">

                <!-- form start -->
                <form data-validate-parsley action="{{ url('admin/adresse/'.$adresse->id) }}" method="POST" class="form-horizontal" >
                    <input type="hidden" name="_method" value="PUT">
                    {!! csrf_field() !!}

                    <div class="panel-heading"><h4>&Eacute;diter</h4></div>
                    <div class="panel-body event-info">

                        <input type="hidden" name="tribunaux_id" value="{{ $adresse->tribunaux_id }}">
                        <input type="hidden" name="id" value="{{ $adresse->id }}">

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label"><strong>Français</strong></label>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Titre</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" value="{{ $adresse->titre }}" class="form-control" name="titre" placeholder="">
                                    <span class="input-group-addon">fr</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Contenu</label>
                            <div class="col-sm-6">
                                {!! Form::textarea('contenu', $adresse->contenu , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '3' )) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label"><strong>Allemand</strong></label>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Titre</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" value="{{ $adresse->titre_de }}" class="form-control" name="titre_de" placeholder="">
                                    <span class="input-group-addon">all</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Contenu</label>
                            <div class="col-sm-6">
                                {!! Form::textarea('contenu_de',  $adresse->contenu_de , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '3' )) !!}
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