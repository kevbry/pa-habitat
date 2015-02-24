@extends('master')

@section('title')
All Volunteers
@stop

@section('content')

<h1>Volunteers</h1>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Name
                
                @if ($sortby == 'l' && $order == 'd')
                 <a href='{{action(
                           'VolunteerController@index',
                            array(
                               'sortby' => 'l',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'VolunteerController@index',
                            array(
                               'sortby' => 'l',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                    @endif
                    
            </th>
            
            <th>Phone</th>
            
            <th>Email
            @if ($sortby == 'e' && $order == 'd')
                 <a href='{{action(
                           'VolunteerController@index',
                            array(
                               'sortby' => 'e',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'VolunteerController@index',
                            array(
                               'sortby' => 'e',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                    @endif</th>
            <th></th>
        </tr>
    </thead>
    @foreach($volunteers as $volunteer)
    <tr>
        <td>{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</td>
        <td>@if (!empty($volunteer->contact->home_phone))
                {{$volunteer->contact->home_phone}}
                @elseif (!empty($volunteer->contact->cell_phone))
                {{$volunteer->contact->cell_phone}}
                @else 
                {{$volunteer->contact->work_phone}}
                @endif</td>
        <td>{{$volunteer->contact->email_address}}</td>
        <td><a href="contact/{{$volunteer->id}}">View Details</a> | <a href="contact/{{$volunteer->id}}/edit">Edit Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $volunteers->appends(array('sortby' => $sortby, 'order'=> $order ))->links(); ?>
@stop
