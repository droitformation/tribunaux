<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Administration</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tribunauxcivils | administration">
    <meta name="author" content="Cindy Leschaud | @DesignPond">
    <meta name="_token" content="<?php echo csrf_token(); ?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo asset('backend/css/styles.css?=121');?>">
    <link rel="stylesheet" href="<?php echo asset('backend/js/vendor/redactor/redactor.css'); ?>">
    <link rel='stylesheet' type='text/css' href="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="<?php echo asset('backend/css/chosen.css');?>">
    <link rel="stylesheet" href="<?php echo asset('backend/css/chosen-bootstrap.css');?>">
    <link rel="stylesheet" href="<?php echo asset('backend/css/jquery-ui.min.css');?>">
    <link rel="stylesheet" href="<?php echo asset('backend/css/jquery.contextMenu.css');?>">
    <link rel="stylesheet" href="<?php echo asset('backend/css/jquery.ui.rotatable.css');?>">
    <link rel="stylesheet" href="<?php echo asset('backend/css/admin.css');?>">
    <link rel="stylesheet" href="<?php echo asset('backend/css/types.css');?>">
    <link rel="stylesheet" href="<?php echo asset('backend/css/dnd.css');?>">
    <link rel="stylesheet" href="<?php echo asset('frontend/css/suisse.css');?>">

    <link rel='stylesheet' type='text/css' href="<?php echo asset('backend/plugins/form-nestable/jquery.nestable.css');?>" />

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url'   => url('/'),
            'ajaxUrl' => url('admin/ajax/'),
            'adminUrl' => url('admin/')
        ]); ?>
    </script>

    <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo asset('backend/css/styles.ie8.css');?>">
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>

    <![endif]-->

    <base href="/">

</head>
<body>

<?php $current_user = (isset(Auth::user()->name) ? Auth::user()->name : ''); ?>

<header class="navbar navbar-inverse navbar-fixed-top" role="banner">

    <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>
    <div class="navbar-header pull-left"><a class="navbar-brand" href="{{ url('/')  }}">Tribunauxcivils</a></div>

    <ul class="nav navbar-nav pull-right toolbar">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
               <span class="hidden-xs">&nbsp;{{ $current_user }}<i class="fa fa-caret-down"></i></span>
            </a>
            <ul class="dropdown-menu userinfo arrow">
                <li class="username">
                    <a href="#"><div class="pull-right"><h5>Bonjour, {{ $current_user }}!</h5></div></a>
                </li>
                <li class="userlinks">
                    <ul class="dropdown-menu">
                        <li>
                            <form class="logout" action="{{ url('logout') }}" method="POST">{{ csrf_field() }}
                                <button class="btn btn-default" type="submit" style="margin-left: 5px;">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</header>

<div id="page-container">

    <!-- Navigation  -->
    @include('backend.partials.navigation')

    <div id="page-content">
        <div id='wrap'>

            <div id="page-heading"><h2>Administration</h2></div>

            <div class="container">

                <!-- messages and errors -->
                @include('backend.partials.message')

                <!-- Contenu -->
                @yield('content')
                <!-- Fin contenu -->

            </div> <!-- container -->
        </div> <!--wrap -->
    </div> <!-- page-content -->

    <footer role="contentinfo">
        <div class="clearfix">
            <ul class="list-unstyled list-inline pull-left">
                <li>Tribunauxcivils &copy; <?php echo date('Y'); ?></li>
            </ul>
            <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
        </div>
    </footer>

</div> <!-- page-container -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="<?php echo asset('backend/js/validation/messages_fr.js');?>"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo asset('backend/js/vendor/redactor/redactor.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/vendor/chosen/chosen.jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/enquire.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/jquery.cookie.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/jquery.nicescroll.min.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/plugins/form-toggle/toggle.min.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/placeholdr.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/vendor/redactor/fr.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/vendor/redactor/addmodal.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/vendor/redactor/modal.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/vendor/redactor/schema.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/vendor/redactor/imagemanager.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/vendor/redactor/filemanager.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/vendor/redactor/fontsize.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/vendor/redactor/fontcolor.js');?>"></script>
<script type='text/javascript' src="<?php echo asset('backend/plugins/form-multiselect/js/jquery.multi-select.js');?>"></script>
<script type='text/javascript' src="<?php echo asset('backend/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type='text/javascript' src="<?php echo asset('backend/plugins/datatables/dataTables.bootstrap.js');?>"></script>
<script type='text/javascript' src="<?php echo asset('backend/plugins/form-datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type='text/javascript' src="<?php echo asset('backend/plugins/form-nestable/jquery.nestable.min.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/datatables.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/main.js');?>"></script>
<script type='text/javascript' src="<?php echo asset('backend/plugins/bootbox/bootbox.min.js');?>"></script>
<script type='text/javascript' src="<?php echo asset('backend/js/nestable.js');?>"></script>
<script type='text/javascript' src="<?php echo asset('backend/js/Sortable.min.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('backend/js/admin.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('js/app.js');?>"></script>

</body>
</html>