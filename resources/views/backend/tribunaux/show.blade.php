@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/tribunaux/') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>

<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form data-validate-parsley action="{{ url('admin/tribunaux/'.$tribunal->id) }}" method="POST" class="form-horizontal" >
                <input type="hidden" name="_method" value="PUT">
                {!! csrf_field() !!}

                <div class="panel-heading">
                    <h4>&Eacute;diter {{ $tribunal->titre }}</h4>
                </div>
                <div class="panel-body event-info">

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Titre fr.</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="{{ $tribunal->titre }}" class="form-control" name="titre">
                                <span class="input-group-addon">fr</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Adresse fr.</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('info', $tribunal->info , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6' )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Titre all.</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="{{ $tribunal->titre_de }}" class="form-control" name="titre_de" placeholder="">
                                <span class="input-group-addon">all</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Adresse all.</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('info_de', $tribunal->info_de , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6' )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Canton</label>
                        <div class="col-sm-6">

                            @if(!$cantons->isEmpty())
                                <select class="form-control" name="canton_id">
                                    <option value="">Choix</option>
                                    @foreach($cantons as $canton)
                                        <option {{ $tribunal->canton_id == $canton->id ? 'selected' : ''}} value="{{ $canton->id }}">{{ $canton->titre }}</option>
                                    @endforeach
                                </select>
                            @endif
                            <br/>

                            <?php $position = explode(',',$tribunal->position);  ?>

                            <div id="droppable">
                                <p id="draggable" data-top="{{ $position[0] }}" data-left="{{ $position[1] }}" style=" padding: 0;margin: 0;height: 26px;width: 26px;">
                                    <img src="{{ asset('images/tf.png') }}" alt="Tribunal" />
                                </p>
                                @include('frontend.partials.map',['id' => $tribunal->canton_id])
                            </div>
                            <input id="position" type="hidden" name="position" value="{{ $tribunal->position }}">

                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer ">
                    <div class="col-sm-3">{!! Form::hidden('id', $tribunal->id ) !!}</div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary" type="submit">Envoyer </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
<!-- end row -->

@stop