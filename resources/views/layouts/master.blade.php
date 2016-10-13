<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="@Designpond | Cindy Leschaud">
    <meta name="description" content="Tribunaux civils | Faculté de droit, Universite de Neuchâtel">
    <title>Tribunaux civils</title>
    <meta name="_token" content="<?php echo csrf_token(); ?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/font/stylesheet.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/chosen/chosen.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/select2.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/jquery.qtip.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/ui-lightness/jquery-ui.css');?>">

</head>
<body>

<div id="menuhaut">
    <div class="container">
        <div class="row">
            <?php $locale = (\Session::has('locale') ? \Session::get('locale') : 'fr'); ?>
            <div class="col-md-6" id="langue">
                <a class="<?php echo ($locale == 'fr' ? 'active' : ''); ?>" href="{{ url('setlang/fr') }}">FR</a> /
                <a class="<?php echo ($locale == 'de' ? 'active' : ''); ?>" href="{{ url('setlang/de') }}">DE </a>
            </div>
            <div class="col-md-6" id="slideMenu">

                <ul>
                    @if(!$menus->isEmpty())
                        @foreach($menus as $menu_title)
                            <li data-id="menu_{{ $menu_title->link }}" class="{{ $menu_title->link }}"><a href="#">{{ $menu_title->titre_trans }}</a></li>
                        @endforeach
                    @endif
                </ul>

            </div>
        </div>
    </div>

    <div id="slideMenuOpen">

        @if(!$menus->isEmpty())
            @foreach($menus as $menu)
                <div class="hold{{ $menu->link }} hold" id="menu_{{ $menu->link }}">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>{{ $menu->titre_trans }}</h1>
                                {!! $menu->contenu_trans !!}
                                <a class="close" href="#">{{ trans('carte.close') }}</a>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        @endif

        <div class="holder"></div>

    </div>

</div>

<div class="container">
    <header>
        <div class="row">
            <div class="col-md-3 unine" style="width:20%">
                <a href="http://www2.unine.ch/droit/page-1762.html" target="_blank"><img width="87" src="{{ asset('images/unine.png') }}" alt="" /></a>
                <a href="http://www2.unine.ch/cemaj" target="_blank"><img src="{{ asset('images/cemaj.png') }}" alt="" /></a>
            </div>
            <div class="col-md-6">
                <h1><a href="{{ url('/') }}">{!! trans('carte.site') !!}</a></h1>
            </div>
            <div class="col-md-3 text-right" style="width:30%">
                <p class="btn btn-default"><a href="{{ url('/') }}">{{ trans('carte.retour') }}</a></p>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div id="search">
                <div class="pull-right">
                    <p class="titre">{!! trans('carte.search') !!}</p>
                    @include('frontend.partials.search')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <section class="col-md-12">

            <!-- Contenu -->
            @yield('content')
            <!-- Fin contenu -->

            <p class="copyright">Source des cartes vectorielles : <a href="http://d-maps.com">d-maps.com</a></p>

        </div>
    </div>
</div> <!--! end  -->

@include('frontend.partials.sites')

<!-- javascripts -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo asset('frontend/js/jquery/jquery-ui-1.8.16.custom.min.js');?>"></script>
<script src="<?php echo asset('frontend/js/jquery/jquery.cycle2.min.js');?>"></script>
<script src="<?php echo asset('frontend/js/jquery/jquery.hoverIntent.minified.js');?>"></script>
<script src="<?php echo asset('frontend/js/jquery/jquery.listmenu-1.1.js');?>"></script>
<script src="<?php echo asset('frontend/js/jquery/jquery.qtip.js');?>"></script>
<script src="<?php echo asset('frontend/chosen/chosen.jquery.js');?>"></script>
<script src="<?php echo asset('frontend/js/select2.js');?>"></script>
<script src="<?php echo asset('frontend/js/main.js');?>"></script>
<script src="<?php echo asset('frontend/js/script.js');?>"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- Change UA-XXXXX-X to be your site's ID -->
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-28717463-1']);
    _gaq.push(['_trackPageview']);
    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>

</body>
</html>