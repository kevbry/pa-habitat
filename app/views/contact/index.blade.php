@extends('master')

@section('title')
Index of all contacts
@stop

@section('content')

<h1>Contacts</h1>
<nav>
@if (Auth::check() && (Session::get('access_level') !== 'basic_user' ))
<a href="contact/create" class="btn btn-primary">Add Contact</a>
@endif
</nav>
<table class="table table-hover">
    <thead>
         <tr>
            <th>Name
                @if ($sortby == 'l' && $order == 'd')
                 <a href='{{action(
                           'ContactController@index',
                            array(
                               'sortby' => 'l',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'ContactController@index',
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
                           'ContactController@index',
                            array(
                               'sortby' => 'e',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'ContactController@index',
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
    @if (!empty($contacts))
        @foreach($contacts as $contact)
        <tr>
            <td>{{$contact->first_name . ' ' . $contact->last_name}}</td>
            <td>@if (!empty($contact->home_phone))
                {{$contact->home_phone}}
                @elseif (!empty($contact->cell_phone))
                {{$contact->cell_phone}}
                @else 
                {{$contact->work_phone}}
                @endif</td>
            <td>{{$contact->email_address}}</td>
            <td><a href="contact/{{$contact->id}}">View Details</a> 
                @if (Auth::check() && (Session::get('access_level') !== 'basic_user' ))
                | <a href="contact/{{$contact->id}}/edit">Edit Details</a>
                @endif
            </td>
                
        </tr>
        @endforeach
    @endif
</table>
<?php echo $contacts->appends(array('sortby' => $sortby, 'order'=> $order ))->links(); ?>
@stop
