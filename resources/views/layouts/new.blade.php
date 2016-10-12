<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>FlatLab - Flat & Responsive Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!--external css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/font/stylesheet.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/slidebars.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/style.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/chosen/chosen.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/menu.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/suisse.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/style-responsive.css');?>">

</head>
<body>

<section id="container" class="page-wrap">
    <!--header start-->
    <header class="header white-bg">
        <div class="navbar-menu">
            @include('frontend.partials.menu')
        </div>
        <div class="heading">
            <!--logo start-->
            <h1><a href="{{ url('/') }}">{!! trans('carte.site') !!}</a></h1>

            <!--logo end-->
            <a class="logo" href="http://www2.unine.ch/droit/page-1762.html" target="_blank"><img width="87" src="{{ asset('images/unine.png') }}" alt="" /></a>
            <a class="logo" href="http://www2.unine.ch/cemaj" target="_blank"><img src="{{ asset('images/cemaj.png') }}" alt="" /></a>
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="sidebar-close sidebar-open">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li class="search">
                    @include('frontend.partials.search')
                </li>
                <li class="sub-menu">
                    <a class="sublink active" href="javascript:;"><i class="fa fa-laptop"></i><span>fre</span></a>
                    <ul class="sub">
                        <li>
                           <p>Dapibus ante accumasa laoreet mauris nostie vehicula non interdùm, vehiculâ suscipit alèquam.
                               Lorem ad quîs j'libéro pharétra vivamus mollis ultricités ut, vulputaté ac pulvinar èst
                               commodo aenanm pharétra cubilia, lacus aenean pharetra des ïd quisquées mauris varius sit.
                               Mie dictumst nûllam çurcus molestié imperdiet vestibulum suspendisse tempor habitant imiés ?</p>
                        </li>
                    </ul>
                </li>
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

<!--footer start-->
<footer class="site-footer">
    <div class="text-center">
        {{ date('Y') }} &copy; {!! trans('carte.site') !!}
        <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
    </div>
</footer>
<!--footer end-->

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
