@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/districts') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form  action="{{ url('admin/title') }}" method="POST" class="form-horizontal" >{!! csrf_field() !!}

                <div class="panel-heading"><h4>Ajouter un titre pour {{ $district->nom }}</h4></div>
                <div class="panel-body event-info" id="app">

                    <district-title path="{{ url('cantons/'.$district->canton_id.'.png')}}"></district-title>

                </div>
                <div class="panel-footer mini-footer ">
                    <div class="col-sm-3"><input type="hidden" name="canton_id" value="{{ $district->canton_id }}"></div>
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