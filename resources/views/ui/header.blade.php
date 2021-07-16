<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artist Phan Sang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,400;1,100;1,400&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('ui/css/reset.css')."?v=".time() }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('ui/css/plugins.css')."?v=".time() }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('ui/css/style.css')."?v=".time() }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('ui/css/yourstyle.css')."?v=".time() }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('ui/css/jquery.magnify.css')."?v=".time() }}">
    <link rel="shortcut icon" href="{{ asset('ui/images/lg.png')."?v=".time() }}">
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBH0JMeOtNCkrcnRkKZMVxRxlIwVGIS2gI&callback=initMap&libraries=&v=weekly"
        defer
    ></script>
    <style>
        .toggle-mode  {
            position: fixed;
            left: 34px;
            width: 130px;
            height: 40px;
            top: 50%;
            margin-top: 50px;
            letter-spacing: 0.17em;
            font-size: 10px;
            text-transform: uppercase;
            margin-left:-34px;
            text-align: center;
            cursor: default;
            transform: rotate(-90deg);
            transform-origin: left top;
            z-index:12;
            font-family: 'Raleway';
            display: flex;
            justify-content: center;
            align-items: center;
            background: black;
            cursor: pointer;
        }
        .toggle-mode:after {
            display: none;
        }
        .toggle-mode:hover{
            background: #F6F1EB;
        }
        .toggle-mode:hover span{
            color: black;
        }
        #dark-title.toggle-mode{
            background: #F6F1EB;
        }
        #dark-title.toggle-mode:hover{
            background: #0E0E14;
        }
        #dark-title.toggle-mode:hover span{
            color: white;
        }
        @media (max-width:991px){
            .fixed-title.toggle-mode.cursor-pt{
                display: none;
            }
            body{
                background: white;
            }
            body#dark{
                background: #0a0a0e;
            }
        }
    </style>
    @yield('css')
</head>
@php 
$is_dark = \Session::get('is_dark');
@endphp
<body @if($is_dark) id="dark" @endif>
<div class="loader"><i class="fa fa-refresh fa-spin"></i></div>
<div id="main">
    <header id="<?php echo($is_dark ? "dark-mode" : "")?>">
        <div class="header-inner">
            <div class="logo-holder cursor-pt">
                <a href="{{ route('ui.index') }}"><img class="logo-img" src="{{asset("ui/images/lg.png")}}"></a>
            </div>
            <div class="nav-button-holder">
                <div class="nav-button vis-m"><span class="<?php echo($is_dark ? "dark-mode-icon" : "")?>"></span><span class="<?php echo($is_dark ? "dark-mode-icon" : "")?>"></span><span class="<?php echo($is_dark ? "dark-mode-icon" : "")?>"></span></div>
            </div>
            <div class="nav-holder">
                <nav>
                    <ul>
                        <?php $route = Route::currentRouteName() ?>
                        <li><a href="{{ route('ui.about_me') }}" class="{{ in_array($route, ['ui.about_me']) ? 'act-link' : '' }}">{{ __('labels.about_me') }}</a></li>
                        <li><a href="{{ route('ui.collection_v2') }}" class="{{ $route=='ui.collection_v2' ? 'act-link' : '' }}">{{ __('labels.collections') }}</a></li>
                        <li><a href="{{ route('ui.news') }}" class="{{ $route=='ui.news' ? 'act-link' : '' }}">{{ __('labels.news') }}</a></li>
                        <li><a href="{{ route('ui.studio') }}" class="{{ $route=='ui.studio' ? 'act-link' : '' }}">{{ __('labels.studio') }}</a></li>
                        <li><a href="{{ route('ui.contact') }}" class="{{  $route=='ui.contact' ? 'act-link' : '' }}">{{ __('labels.contact') }}</a></li>
                        <li><a href="{{ route('ui.index') }}" class="{{ $route=='ui.index' ? 'act-link' : '' }}">{{ __('labels.home') }}</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!--<a id="<?php echo($is_dark ? "dark-title" : "")?>" class="fixed-title toggle-mode cursor-pt" href="{{ url('switch-mode') }}">
        <span><?php echo($is_dark ? "Dark Mode" : "Light Mode");?></span>
    </a>-->