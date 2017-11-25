<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/sb-admin-2.min.css") }}" rel="stylesheet">
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url("admin/assets") }}">SB Admin v2.0</a>
        </div>
        <!-- /.navbar-header -->

        <div id="left">
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a href="{{ url("admin/overview") }}"><i class="fa fa-dashboard"></i> Pregled</a></li>
                        <li><a href="{{ url("admin/products") }}"><i class="fa fa-dashboard"></i> Proizvodi</a></li>
                        <li><a href="{{ url("admin/categories") }}"><i class="fa fa-list"></i> Kategorije</a></li>
                        <li><a href="{{ url("admin/colors") }}"><i class="fa fa-dashboard"></i> Boje</a></li>
                        <li><a href="{{ url("admin/orders") }}"><i class="fa fa-dollar"></i> Porudzbine</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@yield('page-title')</h1>
            </div>
        </div>
        <div id="row">
            @yield("content")
        </div>

    </div>
</body>
<?php
    echo "<script> var base_url = '". url("/") .  "';</script>";
?>
<script src="{{ asset("js/jquery.min.js") }}"></script>
<script src="{{ asset("js/ajax.js") }}"></script>
<script src="{{ asset("js/vue/dist/vue.js") }}"></script>
@yield("components")

<script src="{{ asset("js/bootstrap.min.js") }}"></script>
<script src="{{ asset("js/vue.js") }}"></script>
</html>
