@extends('master')

@section('title')
Index of all Companies
@stop

@section('content')

<h1>Companies</h1>
<a href="contact/create">Add Company</a>

<table>
    <tr>
        <th>Company Name</th><th>Contact Name</th>
    </tr>
    <tr>
        <td>{{$company->Company_name}}</td>
        <td>{{$contact->first_name . ' ' . $contact->last_name}}</td>
        <td><a href="contact/{{$contact->id}}">View Contact Details</a></td>
    </tr>
    @endforeach
</table>
@stop