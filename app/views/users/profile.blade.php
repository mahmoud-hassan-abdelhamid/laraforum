
@extends('layouts.main')
@section('content')
<style type="text/css">
table tr td{
	text-align: center;
}
</style>
<div class="col-md-3"></div>
<div class="col-md-6">
<table class="table table-bordered profile-view">
<tr>
	<td rowspan="2"> @if($user->pic) <img class="img-responsive img-thumbnail" style="width:100% !important;" src='{{URL::asset("usersPics/$user->pic")}}'/>
		@else <img src='{{URL::asset("usersPics/no.jpg")}}'/> @endif
	</td>
	<td> {{ $user->email }}</td>
</tr>

<tr>
	<td>{{ $user->role }}</td>
</tr>
</table>
<br><br>
@if((!is_null(Auth::user()) && Auth::user()->id== $user->id ) || (!is_null(Auth::user()) && Auth::user()->role=='admin') )
<a href='{{URL::to("user/$user->id/editProfile")}}' class="btn btn-primary">Edit Profile</a>
@endif
</div>
<div class="col-md-3"></div>

@stop