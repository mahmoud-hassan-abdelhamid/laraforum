<html>
<head>
<title>Lara Forum</title>

{{ HTML::style('css/bootstrap3.min.css') }}
{{ HTML::style('https://fonts.googleapis.com/css?family=Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic&#038;subset=latin,latin-ext') }}
{{ HTML::style('css/glyphicons.pro.css') }}
{{ HTML::style('css/style.css') }}
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('js/bootstrap3.min.js') }}

</head>


<body>
<header>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::to('home') }}">Lara Forum</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

<ul class="nav navbar-nav">
<li class=""><a href="{{ URL::to('home') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
@if( is_null( Auth::user()) )  
<li class=""><a href="{{ URL::to('register') }}"><span class="glyphicon glyphicon-pencil"></span> Register</a></li>
<li><a href="{{ URL::to('login') }}"><span class="glyphicon glyphicon-user"></span> Login</a></li>
@endif
</ul>
@if( ! is_null( Auth::user()) && Auth::user()->role == 'admin' ) 

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Control<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::to('users') }}">Users</a></li>
            <li><a href="{{ URL::to('categories') }}">Categories</a></li>
            <li><a href="{{ URL::to('forums') }}">Forums</a></li>
            <li><a href="{{ URL::to('threads') }}">Threads</a></li>
          </ul>
        </li>
      </ul>
@endif

@if( (! is_null( Auth::user())) ) 
<?php $uid=Auth::user()->id ;?>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome Back {{ Auth::user()->email }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href='{{ URL::to("user/$uid/viewProfile") }}'>Profile</a></li>
            <li><a href="{{ URL::to('logout') }}">Logout</a></li>
          </ul>
        </li>
      </ul>
@endif

    </div>
  </div>
</nav>

</header>

<div class="row">
	<div class="container main-container">
	@yield('content')
	</div>
</div>

</body>
</html>