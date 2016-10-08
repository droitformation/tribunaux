<!-- BEGIN SIDEBAR -->
<nav id="page-leftbar" role="navigation">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="acc-menu" id="sidebar">
        <!-- Recherche globale -->
       <!-- @include('backend.partials.search')-->

        <li class="divider"></li>
        <li class="<?php echo (Request::is('admin') ? 'active' : '' ); ?>"><a href="{{ url('admin') }}">
             <i class="fa fa-home"></i> <span>Accueil</span></a>
        </li>
        <li class="<?php echo (Request::is('tribunaux') || Request::is('tribunaux/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/tribunaux') }}">
                <i class="fa fa-gavel"></i> <span>Tribunaux</span></a>
        </li>
        <li class="<?php echo (Request::is('menu') || Request::is('menu/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/menu') }}">
                <i class="fa fa-list"></i> <span>Menu</span></a>
        </li>
    <!--  <li class="<?php //echo (Request::is('admin/config') ? 'active' : ''); ?>">
            <a href="{{ url('admin/config') }}"><i class="fa fa-cog"></i><span>Configurations</span></a>
        </li>-->
    </ul>
    <!-- END SIDEBAR MENU -->
</nav>