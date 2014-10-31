@extends('master')

@section('title')
Contact Details
@stop

@section('content')
<h1>Contact details</h1>
<h3>{{ $contact->first_name . " " . $contact->last_name }}</h3>

 {{ Form::open() }}
 <div>
     {{ Form::label('email_address','Email: ') }}
     {{ Form::text('email_address',$contact->email_address) }}
 </div>
 <div>
     {{ Form::label('home_phone','Home Phone: ') }}
     {{ Form::text('home_phone',$contact->home_phone) }}
 </div>
 <div>
     {{ Form::label('cell_phone','Cell Phone: ') }}
     {{ Form::text('cell_phone',$contact->cell_phone) }}
 </div>
 <div>
     {{ Form::label('work_phone','Work Phone: ') }}
     {{ Form::text('work_phone',$contact->work_phone) }}
 </div>
 <div>
     {{ Form::label('street_address','Street Address: ') }}
     {{ Form::text('street_address',$contact->street_address) }}
 </div>
 <div>
     {{ Form::label('city','City: ') }}
     {{ Form::text('city',$contact->city) }}
 </div>
 <div>
     {{ Form::label('province','Province: ') }}
     {{ Form::text('province',$contact->province) }}
 </div>
 <div>
     {{ Form::label('postal_code','Postal Code: ') }}
     {{ Form::text('postal_code',$contact->postal_code) }}
 </div>
 <div>
     {{ Form::label('country','Country: ') }}
     {{ Form::text('country',$contact->country) }}
 </div>
 <div>
     {{ Form::label('comments','Comments: ') }}
     {{ Form::text('comments',$contact->comments) }}
 </div>
 {{ Form::close() }}

 @stop            
