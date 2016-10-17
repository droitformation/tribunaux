<h2>{!! trans('carte.region') !!}</h2>
<form action="{{ url('search') }}" method="post" class="EnvoiDonnees">
    {!! csrf_field() !!}
    <select data-placeholder="{!! trans('carte.choix') !!}" class="canton-select" tabindex="2" name="search" style="width: 100%;">
        <option value=""></option>
        @foreach($cdistricts as $district)
            <option value="district-{{ $district->id }}">{{ $district->nom_trans }}</option>
        @endforeach
    </select>
</form>