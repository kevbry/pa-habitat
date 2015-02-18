@extends('master')

@section('title')
Index of all Families
@stop

@section('content')

<h1>Families</h1>
<nav>
<a href="family/create" class="btn btn-primary">Add Family</a>
</nav>
<table class="table table-hover">
    <thead>
        <tr> <th>Name
                @if ($sortby == 'f' && $order == 'd')
                 <a href='{{action(
                           'FamilyController@index',
                            array(
                               'sortby' => 'f',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'FamilyController@index',
                            array(
                               'sortby' => 'f',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                    @endif
                    
            </th>
            
            <th>Phone
            @if ($sortby == 's' && $order == 'd')
                 <a href='{{action(
                           'FamilyController@index',
                            array(
                               'sortby' => 's',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'FamilyController@index',
                            array(
                               'sortby' => 's',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                    @endif</th>
            <th></th></tr>
    </thead>
    @foreach($families as $family)
    <tr>
        <td>{{$family->name}}</td>
        <td>{{$family->status}}</td>
        <td><a href="family/{{$family->id}}">View Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $families->links(); ?>
@stop
