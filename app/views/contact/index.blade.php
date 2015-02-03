@extends('master')

@section('title')
Index of all contacts
@stop

@section('content')

<h1>Contacts</h1>
<nav>
<a href="contact/create" class="btn btn-primary">Add Contact</a>
</nav>
<table class="table table-hover">
    <thead>
         <tr>
            <th>Name
                
                @if ($sortby == 'f' && $order == 'd')
                 <a href='{{action(
                           'ContactController@index',
                            array(
                               'sortby' => 'f',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'ContactController@index',
                            array(
                               'sortby' => 'f',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                    @endif
                    
            </th>
            
            <th>Phone
            @if ($sortby == 'h' && $order == 'd')
                 <a href='{{action(
                           'ContactController@index',
                            array(
                               'sortby' => 'h',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'ContactController@index',
                            array(
                               'sortby' => 'h',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                    @endif</th>
            
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
            <td>{{$contact->home_phone}}</td>
            <td>{{$contact->email_address}}</td>
            <td><a href="contact/{{$contact->id}}">View Details</a></td>
        </tr>
        @endforeach
    @endif
</table>
<?php echo $contacts->links(); ?>
@stop
