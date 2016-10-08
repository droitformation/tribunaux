@if(!$districts->isEmpty())
    <select class="form-control selectLevel" data-level="district" name="district_id">
        <option value="">Choix</option>
        @foreach($districts as $district)
            <option {{ isset($selected['district_id']) && $selected['district_id'] == $district->id ? 'selected' : '' }} value="{{ $district->id }}">{{ $district->nom }}</option>
        @endforeach
    </select>
@endif