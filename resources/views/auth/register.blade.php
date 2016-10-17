@extends('layouts.auth')
@section('content')

    <form class="form-horizontal form-validation" role="form" method="POST" action="register">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="panel-body">
            <h4 class="text-center" style="font-size:14px;margin-bottom: 15px;margin-top:0;">Inscription</h4>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="mot de passe">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmation du mot de passe">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="pull-right">
                <a href="{{ url('/') }}" class="btn btn-default">Retour au site</a>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>

@endsection
