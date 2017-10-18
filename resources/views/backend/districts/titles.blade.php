@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form  action="{{ url('admin/title') }}" method="POST" class="form-horizontal" >{!! csrf_field() !!}

                <div class="panel-heading"><h4>Ajouter les titres pour {{ $canton->titre }}</h4></div>
                <div class="panel-body event-info" id="app">
                    <level-title :titles="{{ json_encode($titles) }}" path="{{ url('cantons/'.$canton->id.'.png')}}"></level-title>
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