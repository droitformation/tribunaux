<form action="{{ url('search') }}" method="post" id="selected">
    {!! csrf_field() !!}

    <div class="input-group">
        <select style="width:300px;" class="form-control chosen-select" data-placeholder="Rechercher" tabindex="2" name="search">
            <option value="">Rechercher</option>

            @if(!$cantons->isEmpty())
                @foreach($cantons as $canton)
                    <option value="canton-{{ $canton->id }}">{!! $canton->titre_trans !!}</option>
                @endforeach
            @endif

            @if(!$districts->isEmpty())
                @foreach($districts as $district)
                    <option value="district-{{ $district->id }}">{!! $district->nom_trans !!}</option>
                @endforeach
            @endif

            @if(!$autorites->isEmpty())
                @foreach($autorites as $autorite)
                    <option value="autorite-{{ $autorite->id }}">{!! $autorite->nom_trans !!}</option>
                @endforeach
            @endif

            @if(!$communes->isEmpty())
                @foreach($communes as $commune)
                    <option value="commune-{{ $commune->id }}">{!! $commune->nom !!}</option>
                @endforeach
            @endif

          </select>
    </div><!-- /input-group -->

</form>