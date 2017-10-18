@if(!$canton->districts->isEmpty())
    <div class="form-group">
        <label for="message" class="col-sm-3 control-label">District</label>
        <div class="col-sm-6">
            <select class="form-control selectLevel" data-level="district" name="district_id">
                <option value="">Choix</option>
                @foreach($canton->districts as $district)
                    <option {{ isset($district_id) && $district_id == $district->id ? 'selected' : '' }} value="{{ $district->id }}">{{ $district->nom }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif