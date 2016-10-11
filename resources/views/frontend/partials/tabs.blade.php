<div class="row">
    <div class="col-md-12">
        <!-- Nav tabs -->
        <div class="card">
            <ul class="nav nav-tabs" role="tablist">
                @if(isset($canton_donnees) && !$canton_donnees->isEmpty())
                    @foreach($canton_donnees as $donnees)
                        <li class="{{ $loop->index == 0 ? 'active' : '' }}"><a href="#tab_{{ $donnees->id }}" data-toggle="tab">{{ $donnees->titre_trans }}</a></li>
                    @endforeach
                @endif
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                @if(isset($canton_donnees) && !$canton_donnees->isEmpty())
                    @foreach($canton_donnees as $donnees)
                        <div role="tabpanel" class="tab-pane {{ $loop->index == 0 ? 'active' : '' }}" id="tab_{{ $donnees->id }}">
                            {!! $donnees->contenu_trans !!}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
