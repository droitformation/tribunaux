<form action="{{ url('search') }}" method="post" class="EnvoiDonnees">
    {!! csrf_field() !!}
    <select data-placeholder="{!! trans('carte.choix') !!}" class="chzn-select" style="width:250px;" tabindex="2" name="search">
        <option value=""></option>
        @foreach($districts as $districts)
            <option value="district-{{ $districts->id }}">{{ $districts->nom_trans }}</option>
        @endforeach
    </select>
</form>