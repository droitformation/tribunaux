@extends('layouts.auth')
@section('content')

    <form class="form-horizontal" role="form" method="POST" action="{{ url('password/email') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="panel-body">
            <h4 class="text-center" style="margin-bottom: 25px;">Demander un nouveau mot de passe</h4>
            <p>Veuillez saisir votre adresse email. Un lien permettant de créer un nouveau mot de passe vous sera envoyé par e-mail.</p>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="email">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="pull-right">
                <a href="{{ url('/') }}" class="btn btn-default">Retour au site</a>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </div>
    </form>

@endsection
