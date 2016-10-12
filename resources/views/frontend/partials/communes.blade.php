<div class="lm-wrapper">
    <div class="panel-body">
        <div class="lm-letters">
            @foreach(range('A', 'Z') as $letter)
                <a class="{{ $letter }}" href="#">{{ $letter }}</a>
            @endforeach
        </div>
    </div>
    <?php
        $locale   = (\Session::has('locale') && \Session::has('locale') == 'de' ? 'de_DE' : 'fr_FR');
        $sorted   = $communes->sortAccent('nom_trans',$locale);
        $grouped  = $sorted->groupBy(function ($item, $key) {
            return substr($item->nom, 0,1);
        });
    ?>

    <div class="lm-menu lm-menu-big">

        @foreach(range('A', 'Z') as $letter)

            <div style="display: none;" class="lm-submenu {{ $letter }}" id="{{ $letter }}">

                @if(isset($grouped[$letter]))

                    <?php
                        $nombre = ceil($grouped[$letter]->count()/6);
                        $chunk  = $grouped[$letter]->chunk($nombre);
                    ?>

                    @foreach($chunk as $row)
                        <div class="lm-col c1 lm-menu-small">
                            <ul class="lm-col-root">
                                @foreach($row as $commune)
                                    <li><a href="{{ url('commune/'.$commune->id)  }}">{!! $commune->nom !!}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach

                @else
                    <div class="lm-col c1 lm-menu-medium">
                        <ul class="lm-col-root" id="lm-listeCommunes-a-1">
                            <li><a href="#">Pas de communes ici</a></li>
                        </ul>
                    </div>
                @endif

            </div>
        @endforeach

    </div>
</div>