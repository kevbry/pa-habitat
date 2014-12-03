<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title') | Habitat For Humanity</title>
        {{ HTML::style('assets/css/style.css'); }}
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <header class="container">
        {{ HTML::image('assets/img/logo.png') }}
        <nav class="navbar navbar-default" role="navigation">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Contacts <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>{{ HTML::linkAction('ContactController@index','All Contacts') }}</li>
                                <li>{{ HTML::linkAction('ContactController@create','Add a Contact') }}</li>
 								<li>{{ HTML::linkAction('DonorController@index','All Donors') }}</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container row center-block">
@yield('content')
    </main>
    <footer class="container">
        <p>Copyright 2014</p>
    </footer>
    
{{ HTML::script('assets/js/jquery-1.11.1.min.js'); }}
{{ HTML::script('assets/js/bootstrap.min.js'); }}
    </body>
</html>
