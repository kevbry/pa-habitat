<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
@yield('title')
        </title>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li>{{ HTML::linkAction('ContactController@index','All Contacts') }}</li>
                    <li>{{ HTML::linkAction('ContactController@create','Add a Contact') }}</li>
                    <li>{{ HTML::linkAction('CompanyController@create','Add a Company') }}</li>
                </ul>
            </nav>
        </header>
@yield('content')
    </body>
</html>
