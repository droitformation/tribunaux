@if( (isset($errors) && count($errors) > 0) )

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dismissable alert-danger">

                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                @foreach($errors->all() as $message)
                    <p>{!! $message !!}</p>
                @endforeach

            </div>
        </div>
    </div>

@endif
