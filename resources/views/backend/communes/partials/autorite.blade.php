@if(!$canton->autorites->isEmpty())
    <div class="form-group">
        <label for="message" class="col-sm-3 control-label">Autorité</label>
        <div class="col-sm-6" id="selectAutorite">
            @include('backend.communes.partials.dropdown', ['list' => $canton->autorites])
        </div>
    </div>
@endif