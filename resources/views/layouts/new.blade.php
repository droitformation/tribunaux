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
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/main-styles.css?');?>{{ rand(1,4000) }}">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/chosen/chosen.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/select2.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/menu.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/suisse.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/sites.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/responsive.css?');?>{{ rand(1,4000) }}">

</head>
<body>

<section class="main-content">

    @include('frontend.parts.header')

    <div class="main-content-inner">

        <aside>
            <div id="sidebar" class="sidebar-close sidebar-open">
                <a href="#" class="trigger-sidebar"><i class="fa fa-bars"></i></a>
                <span class="mini-header"><i class="fa fa-star"></i></span>
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <!-- Sidebar -->
                    @yield('sidebar')
                    <!-- Fin Sidebar -->
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <section>
            <div class="main_map">
                <!-- Contenu -->
                @yield('content')
                <!-- Fin contenu -->
            </div>

            @include('frontend.parts.footer')
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
<script src="{{ asset('frontend/js/imageMapResizer.min.js') }}"></script>
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
