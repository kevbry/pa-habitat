@extends('master')

@section('title')
Index of all users
@stop

@section('content')

<h1>Users</h1>
<nav>
<a href="user/create" class="btn btn-primary">Add User</a>
</nav>
<table class="table table-hover">
    <thead>
         <tr>
            <th>Username

            </th>
            
            <th>Access Level

            <th></th>
        </tr>
    </thead>
    @if (!empty($users))
        @foreach($users as $user)
        <tr>
            <td>{{$user->username}}</td>
            <td>{{ucwords(str_replace('_', ' ', $user->access_level))}}</td>
            <td><a href="user/{{$user->contact_id}}">View Details</a> | <a href="user/{{$user->contact_id}}/edit">Edit Details</a></td>
        </tr>
        @endforeach
    @endif
</table>
<?php //echo $user->appends(array('sortby' => $sortby, 'order'=> $order ))->links(); ?>
@stop
