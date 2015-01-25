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
                
                @if ($sortby == 'first_name' && $order == 'asc')
               <a href="?sort=first_name&order=desc" class="remove"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                    <a href="?sort=first_name&order=asc" class="remove"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
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
