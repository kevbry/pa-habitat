<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title') | Habitat For Humanity</title>
        {{ HTML::style('assets/css/style.css'); }}
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li>{{ HTML::linkAction('ContactController@index','All Contacts') }}</li>
                    <li>{{ HTML::linkAction('ContactController@create','Add a Contact') }}</li>
                </ul>
            </nav>
        </header>
    <main>
@yield('content')
    </main>
{{ HTML::script('assets/javascript/jquery-1.11.1.min.js'); }}
{{ HTML::script('assets/javascript/bootstrap.min.js'); }}
{{ HTML::script('assets/javascript/npm.js'); }}
    </body>
</html>
