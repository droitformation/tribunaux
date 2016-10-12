@extends('layouts.new')
@section('content')
<!--state overview start-->
<div class="row state-overview">
    <div class="col-lg-12 col-sm-12">
        <h2><strong>{!! trans('carte.search_commune') !!}</strong></h2>
        <section class="panel" id="recherche">
            <div class="panel-body">
                @include('frontend.partials.communes')
            </div>
        </section>
    </div>
</div>
<!--state overview end-->

<div class="row">
    <div class="col-lg-8">
        <!--timeline start-->
        <section class="panel">
            <div class="panel-body">
                <div class="text-center mbot30">
                    <h3 class="timeline-title">Timeline</h3>
                    <p class="t-info">This is a project timeline</p>
                </div>

                <div class="timeline">
                    <article class="timeline-item">
                        <div class="timeline-desk">
                            <div class="panel">
                                <div class="panel-body">
                                    <span class="arrow"></span>
                                    <span class="timeline-icon red"></span>
                                    <span class="timeline-date">08:25 am</span>
                                    <h1 class="red">12 July | Sunday</h1>
                                    <p>Lorem ipsum dolor sit amet consiquest dio</p>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="timeline-item alt">
                        <div class="timeline-desk">
                            <div class="panel">
                                <div class="panel-body">
                                    <span class="arrow-alt"></span>
                                    <span class="timeline-icon green"></span>
                                    <span class="timeline-date">10:00 am</span>
                                    <h1 class="green">10 July | Wednesday</h1>
                                    <p><a href="#">Jonathan Smith</a> added new milestone <span><a href="#" class="green">ERP</a></span></p>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="timeline-item">
                        <div class="timeline-desk">
                            <div class="panel">
                                <div class="panel-body">
                                    <span class="arrow"></span>
                                    <span class="timeline-icon blue"></span>
                                    <span class="timeline-date">11:35 am</span>
                                    <h1 class="blue">05 July | Monday</h1>
                                    <p><a href="#">Anjelina Joli</a> added new album <span><a href="#" class="blue">PARTY TIME</a></span></p>
                                    <div class="album">
                                        <a href="#">
                                            <img alt="" src="img/sm-img-1.jpg">
                                        </a>
                                        <a href="#">
                                            <img alt="" src="img/sm-img-2.jpg">
                                        </a>
                                        <a href="#">
                                            <img alt="" src="img/sm-img-3.jpg">
                                        </a>
                                        <a href="#">
                                            <img alt="" src="img/sm-img-1.jpg">
                                        </a>
                                        <a href="#">
                                            <img alt="" src="img/sm-img-2.jpg">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="timeline-item alt">
                        <div class="timeline-desk">
                            <div class="panel">
                                <div class="panel-body">
                                    <span class="arrow-alt"></span>
                                    <span class="timeline-icon purple"></span>
                                    <span class="timeline-date">3:20 pm</span>
                                    <h1 class="purple">29 June | Saturday</h1>
                                    <p>Lorem ipsum dolor sit amet consiquest dio</p>
                                    <div class="notification">
                                        <i class=" fa fa-exclamation-sign"></i> New task added for <a href="#">Denial Collins</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="timeline-item">
                        <div class="timeline-desk">
                            <div class="panel">
                                <div class="panel-body">
                                    <span class="arrow"></span>
                                    <span class="timeline-icon light-green"></span>
                                    <span class="timeline-date">07:49 pm</span>
                                    <h1 class="light-green">10 June | Friday</h1>
                                    <p><a href="#">Jonatha Smith</a> added new milestone <span><a href="#" class="light-green">prank</a></span> Lorem ipsum dolor sit amet consiquest dio</p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="clearfix">&nbsp;</div>
            </div>
        </section>
        <!--timeline end-->
    </div>
    <div class="col-lg-4">
        <!--revenue start-->
        <section class="panel">
            <div class="revenue-head">
                              <span>
                                  <i class="fa fa-bar-chart-o"></i>
                              </span>
                <h3>Revenue</h3>
                              <span class="rev-combo pull-right">
                                 June 2013
                              </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 text-center">
                        <div class="easy-pie-chart">
                            <div class="percentage" data-percent="35"><span>35</span>%</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="chart-info chart-position">
                            <span class="increase"></span>
                            <span>Revenue Increase</span>
                        </div>
                        <div class="chart-info">
                            <span class="decrease"></span>
                            <span>Revenue Decrease</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer revenue-foot">
                <ul>
                    <li class="first active">
                        <a href="javascript:;">
                            <i class="fa fa-bullseye"></i>
                            Graphical
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class=" fa fa-th-large"></i>
                            Tabular
                        </a>
                    </li>
                    <li class="last">
                        <a href="javascript:;">
                            <i class=" fa fa-align-justify"></i>
                            Listing
                        </a>
                    </li>
                </ul>
            </div>
        </section>
        <!--revenue end-->
        <!--features carousel start-->
        <section class="panel">
            <div class="flat-carousal">
                <div id="owl-demo" class="owl-carousel owl-theme">
                    <div class="item">
                        <h1>Flatlab is new model of admin dashboard for happy use</h1>
                        <div class="text-center">
                            <a href="javascript:;" class="view-all">View All</a>
                        </div>
                    </div>
                    <div class="item">
                        <h1>Fully responsive and build with Bootstrap 3.0</h1>
                        <div class="text-center">
                            <a href="javascript:;" class="view-all">View All</a>
                        </div>
                    </div>
                    <div class="item">
                        <h1>Responsive Frontend is free if you get this.</h1>
                        <div class="text-center">
                            <a href="javascript:;" class="view-all">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <ul class="ft-link">
                    <li class="active">
                        <a href="javascript:;">
                            <i class="fa fa-bars"></i>
                            Sales
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class=" fa fa-calendar-o"></i>
                            promo
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class=" fa fa-camera"></i>
                            photo
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class=" fa fa-circle"></i>
                            other
                        </a>
                    </li>
                </ul>
            </div>
        </section>
        <!--features carousel end-->
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <!--latest product info start-->
        <section class="panel post-wrap pro-box">
            <aside>
                <div class="post-info">
                    <span class="arrow-pro right"></span>
                    <div class="panel-body">
                        <h1><strong>popular</strong> <br> Brand of this week</h1>
                        <div class="desk yellow">
                            <h3>Dimond Ring</h3>
                            <p>Lorem ipsum dolor set amet lorem ipsum dolor set amet ipsum dolor set amet</p>
                        </div>
                        <div class="post-btn">
                            <a href="javascript:;">
                                <i class="fa fa-chevron-circle-left"></i>
                            </a>
                            <a href="javascript:;">
                                <i class="fa fa-chevron-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
            <aside class="post-highlight yellow v-align">
                <div class="panel-body text-center">
                    <div class="pro-thumb">
                        <img src="img/ring.jpg" alt="">
                    </div>
                </div>
            </aside>
        </section>
        <!--latest product info end-->
        <!--twitter feedback start-->
        <section class="panel post-wrap pro-box">
            <aside class="post-highlight terques v-align">
                <div class="panel-body">
                    <h2>Flatlab is new model of admin dashboard <a href="javascript:;"> http://demo.com/</a> 4 days ago  by jonathan smith</h2>
                </div>
            </aside>
            <aside>
                <div class="post-info">
                    <span class="arrow-pro left"></span>
                    <div class="panel-body">
                        <div class="text-center twite">
                            <h1>Twitter Feed</h1>
                        </div>

                        <footer class="social-footer">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                                </li>
                            </ul>
                        </footer>
                    </div>
                </div>
            </aside>
        </section>
        <!--twitter feedback end-->
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-xs-6">
                <!--pie chart start-->
                <section class="panel">
                    <div class="panel-body">
                        <div class="chart">
                            <div id="pie-chart" ></div>
                        </div>
                    </div>
                    <footer class="pie-foot">
                        Free: 260GB
                    </footer>
                </section>
                <!--pie chart start-->
            </div>
            <div class="col-xs-6">
                <!--follower start-->
                <section class="panel">
                    <div class="follower">
                        <div class="panel-body">
                            <h4>Jonathan Smith</h4>
                            <div class="follow-ava">
                                <img src="img/follower-avatar.jpg" alt="">
                            </div>
                        </div>
                    </div>

                    <footer class="follower-foot">
                        <ul>
                            <li>
                                <h5>2789</h5>
                                <p>Follower</p>
                            </li>
                            <li>
                                <h5>270</h5>
                                <p>Following</p>
                            </li>
                        </ul>
                    </footer>
                </section>
                <!--follower end-->
            </div>
        </div>
        <!--weather statement start-->
        <section class="panel">
            <div class="weather-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-cloud"></i>
                            California
                        </div>
                        <div class="col-xs-6">
                            <div class="degree">
                                24°
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="weather-category">
                <ul>
                    <li class="active">
                        <h5>humidity</h5>
                        56%
                    </li>
                    <li>
                        <h5>precip</h5>
                        1.50 in
                    </li>
                    <li>
                        <h5>winds</h5>
                        10 mph
                    </li>
                </ul>
            </footer>

        </section>
        <!--weather statement end-->
    </div>
</div>
@stop