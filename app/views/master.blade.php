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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Contacts<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>{{ HTML::linkAction('ContactController@index','All People') }}</li>
                                <li>{{ HTML::linkAction('VolunteerController@index','Just Volunteers') }}</li>
                                <li>{{ HTML::linkAction('DonorController@index','Just Donors') }}</li>
                                <li>{{ HTML::linkAction('CompanyController@index','Companies') }}</li>
                                <li>{{ HTML::linkAction('ContactController@create','Add a Contact') }}</li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Projects<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>{{ HTML::linkAction('ProjectController@index','All Projects') }}</li>
                                <li>{{ HTML::linkAction('ProjectController@create','Add a Project') }}</li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Families<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>{{ HTML::linkAction('FamilyController@index','All Families') }}</li>
                                <li>{{ HTML::linkAction('FamilyController@create','Add a Family') }}</li>
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
