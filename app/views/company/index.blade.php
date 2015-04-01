@extends('master')

@section('title')
All Companies
@stop

@section('content')

<h1>Companies</h1>
<nav>
    @if (Auth::check() && (Session::get('access_level') !== 'basic_user'))
<a href="company/create" class="btn btn-primary">Add Company</a>
    @endif
</nav>
<table class="table table-hover">
    <thead>
        <tr><th>Name
                @if ($sortby == 'n' && $order == 'd')
                 <a href='{{action(
                           'CompanyController@index',
                            array(
                               'sortby' => 'n',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'CompanyController@index',
                            array(
                               'sortby' => 'n',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                    @endif
                    
            </th><th></th></tr>
    </thead>
    @foreach($companies as $company)
    <tr>
        <td>{{$company->name}}</td>
        <td><a href="company/{{$company->id}}">View Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $companies->appends(array('sortby' => $sortby, 'order'=> $order ))->links(); ?>
@stop
