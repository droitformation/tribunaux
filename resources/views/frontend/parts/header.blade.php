<!--header start-->
<div class="navbar-menu">
    <div id="language_menu">
        <?php $locale = (\Session::has('locale') ? \Session::get('locale') : 'fr'); ?>
        <a class="<?php echo ($locale == 'fr' ? 'active' : ''); ?>" href="{{ url('setlang/fr') }}">FR</a> /
        <a class="<?php echo ($locale == 'de' ? 'active' : ''); ?>" href="{{ url('setlang/de') }}">DE </a>
    </div>
    @include('frontend.partials.menu')
</div>
<header id="main_header" class="header white-bg">
    <div class="heading">
        <div class="logos">
            <a class="logo" href="http://www2.unine.ch/droit/page-1762.html" target="_blank"><img width="87" src="{{ asset('images/unine.png') }}" alt="" /></a>
            <a class="logo" href="http://www2.unine.ch/cemaj" target="_blank"><img src="{{ asset('images/cemaj.png') }}" alt="" /></a>
        </div>
    </div>
    <!--logo start-->
    <h1><a href="{{ url('/') }}">{!! trans('carte.site') !!}</a></h1>
    <!--logo end-->
    <div class="break-column"></div>
    <div id="search-select">
        @include('frontend.partials.search')
    </div>
</header>
<!--header end-->