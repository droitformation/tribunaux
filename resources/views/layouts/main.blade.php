
<section id="container" class="page-wrap">
    <!--header start-->
    <header class="header white-bg">
        <div class="navbar-menu">
            <div id="language_menu">
                <?php $locale = (\Session::has('locale') ? \Session::get('locale') : 'fr'); ?>
                <a class="<?php echo ($locale == 'fr' ? 'active' : ''); ?>" href="{{ url('setlang/fr') }}">FR</a> /
                <a class="<?php echo ($locale == 'de' ? 'active' : ''); ?>" href="{{ url('setlang/de') }}">DE </a>
            </div>
            @include('frontend.partials.menu')
        </div>
        <div class="heading">
            <div class="logos">
                <a class="logo" href="http://www2.unine.ch/droit/page-1762.html" target="_blank"><img width="87" src="{{ asset('images/unine.png') }}" alt="" /></a>
                <a class="logo" href="http://www2.unine.ch/cemaj" target="_blank"><img src="{{ asset('images/cemaj.png') }}" alt="" /></a>
            </div>
            <!--logo start-->
            <h1><a href="{{ url('/') }}">{!! trans('carte.site') !!}</a></h1>
            <!--logo end-->
        </div>
        <div id="search-select">
            @include('frontend.partials.search')
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="sidebar-close sidebar-open">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                @if(!$menus->isEmpty() && Request::is('new'))
                    <?php $about = $menus->first(function ($value, $key) {return $value->link == 'about';}); ?>
                    @if($about)
                        <li class="sub-menu">
                            <a class="sublink active" href="javascript:;"><i class="fa fa-home"></i><span>{{ $about->titre_trans }}</span></a>
                            <ul class="sub">
                                <li class="{{ $about->link }}">{!! $about->contenu_trans !!}</li>
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>

    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content" class="main-close main-open">
        <section class="wrapper">

            <!-- Contenu -->
        @yield('content')
        <!-- Fin contenu -->

        </section>
    </section>
    <!--main content end-->
    <div class="clearfix"></div>
</section>


<div class="sites-logos-wrapper logos-">
    <div class="sites-logos">
        <?php $fac_sites = config('sites.fac_sites'); ?>
        @foreach($fac_sites as $name => $logo)
            @if('tribunauxcivils' != $name)
                <a target="_blank" href="{{ $logo['url'] }}">
                    <img src="{{ asset('sites/'.$logo['image']) }}" alt="{{ $name }}" />
                </a>
            @endif
        @endforeach
    </div>
</div>

<!--footer start-->
<footer class="site-footer">
    <div class="text-center">
        {{ date('Y') }} &copy; {!! trans('carte.site') !!}
        <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
    </div>
</footer>
<!--footer end-->