@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/menu') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>

<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form data-validate-parsley action="{{ url('admin/menu/'.$menu->id) }}" method="POST" class="form-horizontal" >
                <input type="hidden" name="_method" value="PUT">
                {!! csrf_field() !!}

                <div class="panel-heading">
                    <h4>&Eacute;diter {{ $menu->titre }}</h4>
                </div>
                <div class="panel-body event-info">

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Rang</label>
                        <div class="col-sm-2">
                            <input type="text" value="{{ $menu->rang }}" class="form-control" name="rang">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Titre fr.</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="{{ $menu->titre }}" class="form-control" name="titre" placeholder="">
                                <span class="input-group-addon">fr</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Contenu fr.</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('contenu', $menu->contenu , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6' )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Titre all.</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="{{ $menu->titre_de }}" class="form-control" name="titre_de" placeholder="">
                                <span class="input-group-addon">all</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Contenu all.</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('contenu_de', $menu->contenu_de , array('class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6' )) !!}
                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer ">
                    <div class="col-sm-3">{!! Form::hidden('id', $menu->id ) !!}</div>
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