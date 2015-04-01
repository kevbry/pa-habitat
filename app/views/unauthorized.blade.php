@extends('master')

@section('title')
Access Denied
@stop

@section('content')
<h2>Access Denied</h2>
<p>You do not have the proper permissions to view this page.</p>  
<p>If you believe this is an error, please contact your system's administrator.</p>

<a href='#' class='back'>Go Back</a>

<script type="text/javascript">
    $(function()
    {
       $(".back").on("click", function(e)
       {
           e.preventDefault();
           window.history.back();
       }) 
    });
</script>

@stop            
