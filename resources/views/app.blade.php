<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flink</title>

    <!-- Fonts -->
    <link href='/{{$appName}}{{$cssPath}}materialize.min.css' rel='stylesheet' type='text/css'>
    <link href='/{{$appName}}{{$cssPath}}common.css' rel='stylesheet' type='text/css'>
    @yield('extraStyle')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo center-align">Flink</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="mobile.html">Mobile</a></li>
            @yield('extraNav')
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="mobile.html">Mobile</a></li>
            @yield('extraNav')
        </ul>
    </div>
</nav>
<div class="container">
<!-- Page Content goes here -->
@yield('content')
</div>
<!-- Scripts -->
<script src="/{{$appName}}{{$jsPath}}jquery-2.1.1.min.js"></script>
<script src="/{{$appName}}{{$jsPath}}materialize.min.js"></script>
@yield('extraScript')
<script type="text/javascript">
$(document).ready(function(){
$(".button-collapse").sideNav();
});
</script>
</body>
</html>