<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{ $title }}</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="{{ $publicUrl }}/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ $publicUrl }}/js/cufon-yui.js"></script>
<script type="text/javascript" src="{{ $publicUrl }}/js/arial.js"></script>
<script type="text/javascript" src="{{ $publicUrl }}/js/cuf_run.js"></script>
<script type="text/javascript" src="{{ $publicUrl }}/js/prefixfree.min.js"></script>

</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="{{ route('cnews.index.index') }}"><span>Web</span>News<br />
          <small>Tin tức 24h</small></a></h1>
      </div>
      <div class="clr"></div>
      <div>
        <ul class="nav">
            <li><a href="{{ route('cnews.index.index') }}" class="active"><span>Trang chủ</span></a></li>
            <li><a href="{{ route('auth.login') }}"><span>Login</span></a></a></li>
            <div id="div-search">
                <li id="search">
                    <form action="{{ route('cnews.search.search') }}" method="get">
                    {{ csrf_field() }}
                        <input type="text" name="search" id="search_text" placeholder="Search"/>
                        <input type="button" name="search" id="search_button"></a>
                    </form>
                </li>
            </div>
        </ul>
        <div class="clr"></div>
  </div>
  