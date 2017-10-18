@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/autorites/canton/'.$canton->id) }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste des glossaires</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form data-validate-parsley action="{{ url('admin/autorite') }}" method="POST" class="form-horizontal" >{!! csrf_field() !!}

                <div class="panel-heading"><h4>Ajouter un autorite pour {{ $canton->titre }}</h4></div>
                <div class="panel-body event-info">

                    @include('backend.communes.partials.district',['canton' => $canton])

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Nom</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="" class="form-control" name="nom" placeholder="">
                                <span class="input-group-addon">fr</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Adresse fr.</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('siege',null, ['class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Nom</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="" class="form-control" name="nom_de" placeholder="">
                                <span class="input-group-addon">all</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Adresse all.</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('siege_de', null, ['class' => 'form-control redactorSimple', 'cols' => '50' , 'rows' => '6']) !!}
                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer ">
                    <div class="col-sm-3"><input type="hidden" name="canton_id" value="{{ $canton->id }}"></div>
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