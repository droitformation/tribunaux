@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/communes/'.$level.'/'.$commune->canton_id) }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>

<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form data-validate-parsley action="{{ url('admin/commune/'.$commune->id) }}" method="POST" class="form-horizontal" >
                <input type="hidden" name="_method" value="PUT">
                {!! csrf_field() !!}

                <div class="panel-heading">
                    <h4>&Eacute;diter {{ $commune->nom }}</h4>
                </div>
                <div class="panel-body event-info">

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Canton</label>
                        <div class="col-sm-6">
                            <input type="text" disabled class="form-control" value="{{ $canton->titre }}">
                            <input type="hidden" name="canton_id" value="{{ $canton->id }}">
                        </div>
                    </div>

                    @include('backend.communes.partials.district',['canton' => $canton])

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
                                <input type="text" value="{{ $commune->nom }}" class="form-control" name="nom">
                                <span class="input-group-addon">fr</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Nom</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" value="{{ $commune->nom_de }}" class="form-control" name="nom_de">
                                <span class="input-group-addon">all</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer ">
                    <div class="col-sm-3">{!! Form::hidden('id', $commune->id ) !!}</div>
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