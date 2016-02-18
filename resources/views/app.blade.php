<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> </title>

	<link href="<% asset('/css/app.css') %>" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<a id="logo-header" href="/"></a>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<ul class="nav navbar-nav">
						<li class="main-page-menu-item"><a href="<% url('/') %>">Главная</a></li>
						<li class="posts-menu-item" ><a href="<% url('/posts') %>">Статьи</a></li>
						<li class="news-menu-item" ><a href="<% url('/news') %>">Новости</a></li>
						<li class="faqs-menu-item" ><a href="<% url('/faqs') %>">Faq</a></li>
					</ul>
					<div class="nav-login">
						@if (Auth::guest())
							<div><a href="<% url('/auth/login') %>">Вход</a></div>
						@else
							<div class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><% Auth::user()->name %> <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="/auth/logout">Logout</a></li>
								</ul>
							</div>
						@endif
					</div>
				</div>
			</div>
		</nav>
	</header>

    @yield('content')

    <footer class="footer">
    </footer>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>
