<?php 

$PAGE_ROOT_URL = explode(Request::path(), Request::url())[0];

// Create the master search box located in the nav bar
$masterSearch = new HabitatSearchBox($PAGE_ROOT_URL, "master-search", "Search..."); 

Session::put('page_url', $PAGE_ROOT_URL);

/*
 *  Configure the search box
 *      Set up how the results are formatted.  First is the attribute to use as the value, second is what to display
 *      Set up the on click method (what happens when a result is selected)
 *      Set up the selection engine(s) that fetches and formats results from the database
 *      Set up the searchbox settings
 */
$masterSearch->configureOnClickEvent(sprintf(HabitatSearchBox::VIEW_DETAILS_ON_CLICK, $PAGE_ROOT_URL))
    ->configureDatumFormat('id', 'name')
    ->configureEngine('contactSearch', HabitatSearchBox::SEARCH_CONTACT_URL, 'Contacts')
    ->configureEngine('volunteerSearch', HabitatSearchBox::SEARCH_VOLUNTEER_URL, 'Volunteers')
    ->configureEngine('projectSearch', HabitatSearchBox::SEARCH_PROJECT_URL, 'Projects')
    ->configureEngine('familySearch', HabitatSearchBox::SEARCH_FAMILY_URL, 'Families')
    ->configureEngine('companySearch', HabitatSearchBox::SEARCH_COMPANY_URL, 'Companies')
    ->configureSettings()
    ->build();

?> 
<!doctype html>
<!--[if lt IE 7]> <html class="ie6" lang="en" itemscope itemtype="https://schema.org/Organization"> <![endif]-->
<!--[if IE 7]>    <html class="ie7" lang="en" itemscope itemtype="https://schema.org/Organization"> <![endif]-->
<!--[if IE 8]>    <html class="ie8" lang="en" itemscope itemtype="https://schema.org/Organization"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js " lang="en" itemscope itemtype="https://schema.org/Organization"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <title>@yield('title') | Habitat For Humanity</title>
        {{ HTML::style('assets/css/style.css'); }}
        
        {{ HTML::script('assets/js/jquery-1.11.1.min.js'); }}
        {{ HTML::script('assets/js/modernizr.js'); }}
        {{ HTML::script('assets/js/bootstrap.min.js'); }}
        {{ HTML::script('assets/js/master.js');}}
        {{ HTML::script('assets/js/dist/typeahead.bundle.js');}}
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <header class="container">
        <div class="col-md-12 pull-right text-right">
            @if (!Auth::check())
            {{ HTML::linkAction('SessionController@create','Login') }}
            @else
            {{ HTML::linkAction('SessionController@destroy','Logout') }}
            @endif
        </div>
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
                        @if (Auth::check() && (Session::get('access_level') !== 'inactive'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Contacts<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>{{ HTML::linkAction('ContactController@index','All People') }}</li>
                                <li>{{ HTML::linkAction('VolunteerController@index','Just Volunteers') }}</li>
                                <li>{{ HTML::linkAction('DonorController@index','Just Donors') }}</li>
                                <li>{{ HTML::linkAction('CompanyController@index','Companies') }}</li>
                                @if (Auth::check() && (Session::get('access_level') !== 'basic_user' ))
                                <li>{{ HTML::linkAction('ContactController@create','Add a Contact') }}</li>
                                @endif
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Projects<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>{{ HTML::linkAction('ProjectController@index','All Projects') }}</li>
                                @if (Auth::check() && (Session::get('access_level') === 'project_manager' || Session::get('access_level') === 'administrator' ))
                                <li>{{ HTML::linkAction('ProjectController@create','Add a Project') }}</li>
                                @endif
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Families<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>{{ HTML::linkAction('FamilyController@index','All Families') }}</li>
                                @if (Auth::check() && (Session::get('access_level') !== 'basic_user' ))
                                <li>{{ HTML::linkAction('FamilyController@create','Add a Family') }}</li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if (Auth::check() && (Session::get('access_level') === 'administrator' || Session::get('access_level') === 'project_manager'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Users<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>{{ HTML::linkAction('UserController@index','All Users') }}</li>
                                <li>{{ HTML::linkAction('UserController@create','Add a User') }}</li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                    @if (Auth::check() && (Session::get('access_level') !== 'inactive'))
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-search"><?php $masterSearch->show(); ?></li>
                    </ul>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    <main class="container row center-block">
@yield('content')
    </main>
    <footer class="container">
        <p>Copyright {{date("Y")}}</p>
    </footer>
    <?php HabitatSearchBox::buildAll(); ?>
    </body>
</html>
