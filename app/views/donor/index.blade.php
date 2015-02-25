@extends('master')

@section('title')
All Donors
@stop

@section('content')

<h1>Donors</h1>
<table class="table table-hover">
    <thead>
        <tr> <th>Name
                
                @if ($sortby == 'l' && $order == 'd')
                 <a href='{{action(
                           'DonorController@index',
                            array(
                               'sortby' => 'l',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'DonorController@index',
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
                           'DonorController@index',
                            array(
                               'sortby' => 'e',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'DonorController@index',
                            array(
                               'sortby' => 'e',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                    @endif</th><th></th></tr>
    </thead>
    @foreach($donors as $donor)
    <tr>
        <td>{{$donor->contact->first_name . ' ' . $donor->contact->last_name}}</td>
        <td>@if (!empty($donor->contact->home_phone))
        {{$donor->contact->home_phone}}
        @elseif (!empty($donor->contact->cell_phone))
        {{$donor->contact->cell_phone}}
        @else 
        {{$donor->contact->work_phone}}
        @endif</td>
        <td>{{$donor->contact->email_address}}</td>
        <td><a href="contact/{{$donor->id}}">View Details</a> | <a href="contact/{{$donor->id}}/edit">Edit Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $donors->appends(array('sortby' => $sortby, 'order'=> $order ))->links(); ?>
@stop
