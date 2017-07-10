<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ $adminUrl }}/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ $adminUrl }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{ $title }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ $adminUrl }}/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ $adminUrl }}/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ $adminUrl }}/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ $adminUrl }}/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ $adminUrl }}/css/themify-icons.css" rel="stylesheet">

    <script src="{{ $adminUrl }}/js/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="{{ $adminUrl }}/js/ckfinder/ckfinder.js" type="text/javascript"></script>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ route('cnews.index.index') }}" class="simple-text">AdminCP</a>
            </div>
            @if(Auth::user() !== null)
                <ul class="nav">
                @php
                    $active = Request::segment(2);
                @endphp
                    <li class="{{ ($active == '') || ($active == 'news') ? 'active' : '' }}">
                        <a href="{{ route('admin.news.index') }}">
                            <i class="ti-map"></i>
                            <p>Tin tức</p>
                        </a>
                    </li>
                     <li class="{{ ($active == 'cat' ? 'active' : '') }}">
                        <a href="{{ route('admin.cat.index') }}">
                            <i class="ti-view-list-alt"></i>
                            <p>Danh mục tin</p>
                        </a>
                    </li>
                    <li class="{{ ($active == 'user') ? 'active' : '' }}">
                        <a href="{{ route('admin.user.index') }}">
                            <i class="ti-user"></i>
                            <p>Danh sách người dùng</p>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="/admin">Trang quản lý</a>
                </div>
                <div class="collapse navbar-collapse">
                @if(Auth::user() !== null)
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ route('auth.logout') }}">
                                <i class="ti-settings"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                @endif
                </div>
            </div>
        </nav>