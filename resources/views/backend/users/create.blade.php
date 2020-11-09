@extends('backend.layouts.master')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/user') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-8 col-xs-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            <form action="{{ url('admin/user') }}" method="post" class="form-validation form-horizontal">{!! csrf_field() !!}

                <div class="panel-heading">
                    <h4>Ajouter un utilisateur/administrateur</h4>
                </div>
                <div class="panel-body event-info">

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Nom</label>
                        <div class="col-sm-6">
                            <input name="name" type="text" value="{{ old('name') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                            <input name="email" type="text" value="{{ old('email') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Mot de passe</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer">
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