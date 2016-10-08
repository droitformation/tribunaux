<form action="{{ url('search') }}" method="post" class="EnvoiDonnees">
    {!! csrf_field() !!}
    <select data-placeholder="{!! trans('carte.choix') !!}" class="chzn-select" style="width:250px;" tabindex="2" name="search">
        <option value=""></option>
        @foreach($autorites as $autorite)
            <option value="autorite-{{ $autorite->id }}">{{ $autorite->nom }}</option>
        @endforeach
    </select>
</form>