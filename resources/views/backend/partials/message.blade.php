@if( isset($errors) && $errors->has() || Session::has('status'))

<div class="row">
    <div class="col-md-12">

        <?php $class  = ($errors->has() ? 'warning' : Session::get('status')); ?>
        <?php $status = ( $class == 'danger' || $class == 'success' ? $class : 'warning' ); ?>

        <div class="alert alert-dismissable alert-{{ $status }}">

            @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
            @endforeach

            @if(Session::has('message'))
                {!! Session::get('message') !!}
            @endif

            @if( $class != 'danger' && $class != 'success' && $class != 'warning' )
                {{ $class }}
            @endif

        </div>

    </div>
</div>

@endif
