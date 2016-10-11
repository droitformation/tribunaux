@extends('layouts.master')
@section('content')

    <h4><a href="{{ url('/') }}">{{ trans('carte.retour') }}</a></h4>

    <div class="container">
        <section class="row">

        <article class="col-md-3">
            <div class="accordion" style="display:none;">
                <h3><a href="#">{{ $tribunal->titre_trans  }}</a></h3>
                <div style="max-height:150px;">
                    {!! $tribunal->info_trans !!}
                </div>
                @if(!$tribunal->tribunaux_donnees->isEmpty())
                    @foreach($tribunal->tribunaux_donnees as $donnee)
                        <h3><a href="#">{{ $donnee->titre_trans }}</a></h3>
                        <div style="max-height:150px;">
                            {!! $donnee->contenu_trans !!}<br/>
                        </div>
                    @endforeach
                @endif
            </div>
        </article>

        <article class="col-md-9">
            <?php $position = explode(',',$tribunal->position);  ?>

            <div id="tribunalWrapper">
                <p style="position: absolute; top: {{ $position[0] - 25 }}px; left: {{ $position[1] }}px; z-index: 100;padding: 0;margin: 0;height: 26px;width: 26px;">
                    <img src="{{ asset('images/tf.png') }}" alt="Tribunal" />
                </p>

                @include('frontend.partials.map',['id' => $tribunal->canton_id, 'canton' =>''])
            </div>
        </article>
    </section>
</div>

@stop