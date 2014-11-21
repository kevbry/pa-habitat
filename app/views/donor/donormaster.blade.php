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
                    <li>{{ HTML::linkAction('DonorController@index','All Donors') }}</li>
                    <li>{{ HTML::linkAction('DonorController@create','Add a Donor') }}</li>
                </ul>
            </nav>
        </header>
@yield('content')
    </body>
</html>

