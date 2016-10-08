@if(!$autorites->isEmpty())
    <select class="form-control" name="autorite_id">
        <option value="">Choix</option>
        @foreach($autorites as $autorite)
            <option  {{ isset($selected['autorite_id']) && $selected['autorite_id'] == $autorite->id ? 'selected' : '' }} value="{{ $autorite->id }}">{{ $autorite->nom }}</option>
        @endforeach
    </select>
@endif