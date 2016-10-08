@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/tribunaux') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form data-validate-parsley action="{{ url('admin/tribunaux') }}" method="POST" class="form-horizontal" >
            {!! csrf_field() !!}

                <div class="panel-heading"><h4>Ajouter un tribunal</h4></div>
                <div class="panel-body event-info">

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Titre fr.</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="" class="form-control" name="titre">
                                <span class="input-group-addon">fr</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Adresse fr.</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('info',null, array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6' )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Titre all.</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="" class="form-control" name="titre_de" placeholder="">
                                <span class="input-group-addon">all</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Adresse all.</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('info_de',null, array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6' )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Canton</label>
                        <div class="col-sm-9">

                            @if(!$cantons->isEmpty())
                                <select class="form-control" name="canton_id" id="selectCanton">
                                    <option value="">Choix</option>
                                    @foreach($cantons as $canton)
                                        <option value="{{ $canton->id }}">{{ $canton->titre }}</option>
                                    @endforeach
                                </select>
                            @endif
                            <br/>

                            <div id="droppable">
                                <p class="pointer" id="draggable" data-top="0" data-left="0" style=" padding: 0;margin: 0;height: 26px;width: 26px;">
                                    <img src="{{ asset('images/tf.png') }}" alt="Tribunal" />
                                </p>
                                <div id="droppableMap"></div>
                            </div>
                            <input id="position" type="hidden" name="position" value="0,0">

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