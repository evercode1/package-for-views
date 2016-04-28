<?php
namespace Evercode1\ViewMaker;

class MasterPageTemplates
{

    public $appName;

    public function __construct($appName)
    {

       $this->appName = $appName;


    }
    public function masterTemplate()
    {

        $content = <<<EOD
<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.meta')

    @yield('title')

    @include('layouts.css')

    @yield('css')

    @include('layouts.shim')

</head>

<body role="document">

    @include('layouts.nav')

    <div class="container theme-showcase" role="main">

    @yield('content')

    @include('layouts.bottom')

    </div> <!-- /container -->

    @include('layouts.scripts')

    @yield('scripts')

</body>
</html>
EOD;


        return $content;

    }

    public function cssTemplate()
    {

        $content = <<<EOD
<!-- Font Awesome -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Bootstrap core CSS -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap theme -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css" rel="stylesheet">

<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.10.1/bootstrap-social.min.css" rel="stylesheet">

<!-- Move style to a permanent home in your main .css file -->
<style>

    body {
        padding-top: 65px; }

</style>
EOD;


        return $content;

    }

    public function bottomTemplate()
    {

        $content = <<<EOD
<hr>
<div class="well">
    <p>&copy;

        @if (date('Y') > 2015)
            2015 - {{ date('Y') }}

        @else

            2015

        @endif

        All rights Reserved.</p>
</div>
EOD;


        return $content;

    }

    public function metaTemplate()
    {

        $content = <<<EOD
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">
<meta name="csrf-token" content="{!! csrf_token() !!}">
EOD;


        return $content;

    }

    public function navTemplate()
    {

        $content = <<<EOD
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Demo</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse pull-right">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#about">About</a></li>

                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
EOD;

        $content = str_replace('Demo', $this->appName, $content);

        return $content;

    }

    public function scriptsTemplate()
    {

        $content = <<<EOD
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

<script src="//maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>
EOD;


        return $content;

    }

    public function shimTemplate()
    {

        $content = <<<EOD
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
EOD;


        return $content;

    }

}