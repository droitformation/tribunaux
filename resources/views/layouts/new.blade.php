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

    <!--right slidebar-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/slidebars.css');?>">
    <!-- Custom styles for this template -->

    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/style.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('frontend/css/style-responsive.css');?>">

</head>

<body>

<section id="container" >
    <!--header start-->
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <i class="fa fa-bars"></i>
        </div>
        <!--logo start-->
        <a href="index.html" class="logo">Flat<span>lab</span></a>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- settings start -->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-tasks"></i><span class="badge bg-success">6</span>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <div class="notify-arrow notify-arrow-green"></div>
                        <li><p class="green">You have 6 pending tasks</p></li>
                        <li class="external"><a href="#">See All Tasks</a></li>
                    </ul>
                </li>
                <!-- settings end -->
            </ul>
            <!--  notification end -->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="index.html">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-laptop"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="boxed_page.html">Boxed Page</a></li>
                        <li><a  href="horizontal_menu.html">Horizontal Menu</a></li>
                        <li><a  href="header-color.html">Different Color Top bar</a></li>
                        <li><a  href="mega_menu.html">Mega Menu</a></li>
                        <li><a  href="language_switch_bar.html">Language Switch Bar</a></li>
                        <li><a  href="email_template.html" target="_blank">Email Template</a></li>
                    </ul>
                </li>
                <!--multi level menu start-->
                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-sitemap"></i>
                        <span>Multi level Menu</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="javascript:;">Menu Item 1</a></li>
                        <li class="sub-menu">
                            <a  href="boxed_page.html">Menu Item 2</a>
                            <ul class="sub">
                                <li><a  href="javascript:;">Menu Item 2.1</a></li>
                                <li class="sub-menu">
                                    <a  href="javascript:;">Menu Item 3</a>
                                    <ul class="sub">
                                        <li><a  href="javascript:;">Menu Item 3.1</a></li>
                                        <li><a  href="javascript:;">Menu Item 3.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!--multi level menu end-->

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <!-- Contenu -->
            @yield('content')
            <!-- Fin contenu -->

        </section>
    </section>
    <!--main content end-->

    <!-- Right Slidebar start -->
    <div class="sb-slidebar sb-right sb-style-overlay">
        <h5 class="side-title">Online Customers</h5>
        <ul class="quick-chat-list">
            <li class="online">
                <div class="media">
                    <a href="#" class="pull-left media-thumb">
                        <img alt="" src="img/chat-avatar2.jpg" class="media-object">
                    </a>
                    <div class="media-body">
                        <strong>John Doe</strong>
                        <small>Dream Land, AU</small>
                    </div>
                </div><!-- media -->
            </li>
            <li class="online">
                <div class="media">
                    <a href="#" class="pull-left media-thumb">
                        <img alt="" src="img/chat-avatar.jpg" class="media-object">
                    </a>
                    <div class="media-body">
                        <div class="media-status">
                            <span class=" badge bg-important">3</span>
                        </div>
                        <strong>Jonathan Smith</strong>
                        <small>United States</small>
                    </div>
                </div><!-- media -->
            </li>

            <li class="online">
                <div class="media">
                    <a href="#" class="pull-left media-thumb">
                        <img alt="" src="img/pro-ac-1.png" class="media-object">
                    </a>
                    <div class="media-body">
                        <div class="media-status">
                            <span class=" badge bg-success">5</span>
                        </div>
                        <strong>Jane Doe</strong>
                        <small>ABC, USA</small>
                    </div>
                </div><!-- media -->
            </li>
            <li class="online">
                <div class="media">
                    <a href="#" class="pull-left media-thumb">
                        <img alt="" src="img/avatar1.jpg" class="media-object">
                    </a>
                    <div class="media-body">
                        <strong>Anjelina Joli</strong>
                        <small>Fockland, UK</small>
                    </div>
                </div><!-- media -->
            </li>
            <li class="online">
                <div class="media">
                    <a href="#" class="pull-left media-thumb">
                        <img alt="" src="img/mail-avatar.jpg" class="media-object">
                    </a>
                    <div class="media-body">
                        <div class="media-status">
                            <span class=" badge bg-warning">7</span>
                        </div>
                        <strong>Mr Tasi</strong>
                        <small>Dream Land, USA</small>
                    </div>
                </div><!-- media -->
            </li>
        </ul>
        <h5 class="side-title"> pending Task</h5>
        <ul class="p-task tasks-bar">
            <li>
                <a href="#">
                    <div class="task-info">
                        <div class="desc">Dashboard v1.3</div>
                        <div class="percent">40%</div>
                    </div>
                    <div class="progress progress-striped">
                        <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <div class="task-info">
                        <div class="desc">Database Update</div>
                        <div class="percent">60%</div>
                    </div>
                    <div class="progress progress-striped">
                        <div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning">
                            <span class="sr-only">60% Complete (warning)</span>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <div class="task-info">
                        <div class="desc">Iphone Development</div>
                        <div class="percent">87%</div>
                    </div>
                    <div class="progress progress-striped">
                        <div style="width: 87%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-info">
                            <span class="sr-only">87% Complete</span>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <div class="task-info">
                        <div class="desc">Mobile App</div>
                        <div class="percent">33%</div>
                    </div>
                    <div class="progress progress-striped">
                        <div style="width: 33%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-danger">
                            <span class="sr-only">33% Complete (danger)</span>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <div class="task-info">
                        <div class="desc">Dashboard v1.3</div>
                        <div class="percent">45%</div>
                    </div>
                    <div class="progress progress-striped active">
                        <div style="width: 45%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="45" role="progressbar" class="progress-bar">
                            <span class="sr-only">45% Complete</span>
                        </div>
                    </div>

                </a>
            </li>
            <li class="external">
                <a href="#">See All Tasks</a>
            </li>
        </ul>
    </div>
    <!-- Right Slidebar end -->

    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2013 &copy; FlatLab by VectorLab.
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="{{ asset('frontend/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.customSelect.min.js') }}"></script>

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
