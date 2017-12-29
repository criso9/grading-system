<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/skins/skin-purple-light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />

	<title>Grading System</title>

</head>
<body>

    <header>
    <div class="navbar navbar-default navbar-fixed-top" id="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><b>Grading System</b></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a class="smoothScroll" href="/">Home</a></li>
                    <li><a class="smoothScroll" href="#about">About</a></li>
                    <li><a class="smoothScroll" href="#contact">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/admin">Login</a></li>
                </ul>
            </div>
        </div>
    </div>


    </header>

    <main class="container">
    	@yield('content')
    </main>

</body>
</html>