<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="@Designpond | Cindy Leschaud">
    <meta name="description" content="Tribunaux civils | Faculté de droit, Universite de Neuchâtel">
    <title>Tribunaux civils</title>
    <meta name="_token" content="<?php echo csrf_token(); ?>">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!--external css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/font/stylesheet.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/slidebars.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/main-styles.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/chosen/chosen.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/select2.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/menu.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/suisse.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/sites.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/responsive.css');?>">

</head>
<body>

<section class="main-content">
    <!--header start-->
    <div class="navbar-menu">
        <div id="language_menu">
            <?php $locale = (\Session::has('locale') ? \Session::get('locale') : 'fr'); ?>
            <a class="<?php echo ($locale == 'fr' ? 'active' : ''); ?>" href="{{ url('setlang/fr') }}">FR</a> /
            <a class="<?php echo ($locale == 'de' ? 'active' : ''); ?>" href="{{ url('setlang/de') }}">DE </a>
        </div>
        {{--   @include('frontend.partials.menu')--}}
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

    <div class="main-content-inner">
        <aside>
            <div id="sidebar" class="sidebar-close sidebar-open">
                <a href="#" class="trigger-sidebar"><i class="fa fa-bars"></i></a>
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    @if(!$menus->isEmpty() && Request::is('new'))
                        <?php
                        $about = $menus->first(function ($value, $key) {
                            return $value->link == 'about';
                        });
                        ?>
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
        <section>

            <div class="main_map">
                <!--state overview start-->
                <div class="row state-overview">
                    <div class="col-lg-12 col-sm-12">
                        <h2>{!! trans('carte.search_commune') !!}</h2>
                        <section class="panel" id="recherche">
                            @include('frontend.partials.communes')
                        </section>
                    </div>
                </div>
                <!--state overview end-->
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12">
                        <h2>{!! trans('carte.search_canton') !!}</h2>
                        <section class="panel">
                            <div class="panel-body">
                                <form action="{{ url('search') }}" method="post" class="EnvoiDonnees">{!! csrf_field() !!}
                                    <select class="canton-select" name="search" tabindex="2" data-placeholder="{!! trans('carte.choix_canton') !!}" style="width: 100%;">
                                        <option value=""></option>
                                        @if(!$cantons->isEmpty())
                                            @foreach($cantons as $canton)
                                                <option value="canton-{{ $canton->id }}">{{ $canton->titre_trans }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </form>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12">

                        <div class="panel">
                            <div class="panel-body">
                                @if(!$tribunaux->isEmpty())
                                    @foreach($tribunaux as $tribunal)
                                        <div id="{{ $tribunal->slug }}"><a href="{{ url('tribunal/'. $tribunal->id) }}" class="selector" title="{{ $tribunal->titre_trans }}"></a></div>
                                    @endforeach
                                @endif

                               @include('frontend.partials.suisse1')
                            </div>
                        </div>
                    </div>

                </div>
            </div>

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
               <p class="text-center">
                   {{ date('Y') }} &copy; {!! trans('carte.site') !!} <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
               </p>
           </div>
        </section>
    </div>
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="{{ asset('frontend/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.customSelect.min.js') }}"></script>

<script src="<?php echo asset('frontend/js/jquery/jquery-ui-1.8.16.custom.min.js');?>"></script>
<script src="<?php echo asset('frontend/js/jquery/jquery.hoverIntent.minified.js');?>"></script>
<script src="<?php echo asset('frontend/chosen/chosen.jquery.js');?>"></script>
<script src="<?php echo asset('frontend/js/select2.js');?>"></script>
<script src="<?php echo asset('frontend/js/main.js');?>"></script>
<script src="<?php echo asset('frontend/js/script.js');?>"></script>

<!--right slidebar-->
<script src="{{ asset('frontend/js/slidebars.min.js') }}"></script>

<!--common script for all pages-->
<script src="{{ asset('frontend/js/common-scripts.js') }}"></script>


<script>
    //custom select box
    $(function(){
        $('select.styled').customSelect();
    });
</script>

</body>
</html>
