<div id="top_menu">
    <ul class="nav top-menu">
        <!-- settings start -->
        @if(!$menus->isEmpty())
            @foreach($menus as $menu)
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">{{ $menu->titre_trans }}</a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <li class="{{ $menu->link }}">{!! $menu->contenu_trans !!}</li>
                    </ul>
                </li>
            @endforeach
        @endif
        <!-- settings end -->
    </ul>
</div>