@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/communes/'.$level.'/'.$where->id) }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form data-validate-parsley action="{{ url('admin/commune') }}" method="POST" class="form-horizontal" >
            {!! csrf_field() !!}

                <div class="panel-heading"><h4>Ajouter une commune pour {{ $where->titre or $where->nom}}</h4></div>
                <div class="panel-body event-info">

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Canton</label>
                        <div class="col-sm-6">
                            <input type="text" disabled class="form-control" value="{{ $canton->titre }}">
                            <input type="hidden" name="canton_id" value="{{ $canton->id }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">District</label>
                        <div class="col-sm-6">
                             @include('backend.communes.partials.district')
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Autorité</label>
                        <div class="col-sm-6">
                            <div id="selectAutorite">
                                @include('backend.communes.partials.autorite')
                            </div>
                        </div>
                    </div>

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
                        <label for="message" class="col-sm-3 control-label">Nom</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="" class="form-control" name="nom_de" placeholder="">
                                <span class="input-group-addon">all</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer ">
                    <div class="col-sm-3">
                        <input type="hidden" name="{{ $level }}_id" value="{{ $where->id }}">
                        <input type="hidden" name="level" value="{{ $level }}">
                    </div>
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