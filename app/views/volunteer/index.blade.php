@extends('master')

@section('title')
All Volunteers
@stop

@section('content')

<h1>Volunteers</h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th>
                
                @if ($sortby == 'first_name' && $order == 'asc')
               {{HTML::linkAction(
                            'VolunteerController@index',
                            'Name',
                            array(
                                'sortby' => 'first_name',
                                'order' => 'desc'
                            )
                        )
                    }}
                    @else 
                    {{HTML::linkAction(
                            'VolunteerController@index',
                            'Name',
                            array(
                                'sortby' => 'first_name',
                                'order' => 'asc'
                            )
                        )
                    }}
                    @endif
            </th>
            <th>Phone</th>
            <th>Email</th>
            <th></th>
        </tr>
    </thead>
    @foreach($volunteers as $volunteer)
    <tr>
        <td>{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</td>
        <td>{{$volunteer->contact->home_phone}}</td>
        <td>{{$volunteer->contact->email_address}}</td>
        <td><a href="contact/{{$volunteer->id}}">View Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $volunteers->links(); ?>
@stop
