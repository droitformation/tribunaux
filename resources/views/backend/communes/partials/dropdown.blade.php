<select class="form-control" name="autorite_id">
    <option value="">Choix</option>
    @foreach($list as $autorite)
        <option {{ isset($autorite_id) && $autorite_id == $autorite->id ? 'selected' : '' }} value="{{ $autorite->id }}">{{ $autorite->nom }}</option>
    @endforeach
</select>