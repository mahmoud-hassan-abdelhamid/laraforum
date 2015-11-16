@extends('layouts.main')
@section('content')

<div class="panel panel-primary">
  <div class="panel-heading forum-heading">{{ $forum->name }}</div>
    <div class="panel-body">
    	@if($forum->thread->count()>0)
  		<table class="table">
	 		<thead>
	 			<th>Thread Name</th>
	 			<th>Written By</th>
	 			<th>Written At</th>
	 			<th>Number Of Replies</th>
	 		</thead>
	 		<tbody> 			
		  	@foreach ($threads as $forum_thread)
		  	@if($forum_thread->stickey)
			  	<tr style="background-color:f5f5f5;">
				  	<td>(Stickey) <a href='{{ URL::to("thread/$forum_thread->id/show") }}'>{{$forum_thread->title}}</a></td>
				  	<td><a href='{{ URL::to("user/$forum_thread->user_id/viewProfile") }}'>{{$forum_thread->user->email}}</a></td>
				  	<td>{{$forum_thread->created_at}}</td>
				  	<td>{{$forum_thread->reply->count()}}</td>
				<tr>	
			@else
				<tr>
				  	<td><a href='{{ URL::to("thread/$forum_thread->id/show") }}'>{{$forum_thread->title}}</a></td>
				  	<td><a href='{{ URL::to("user/$forum_thread->user_id/viewProfile") }}'>{{$forum_thread->user->email}}</a></td>
				  	<td>{{$forum_thread->created_at}}</td>
				  	<td>{{$forum_thread->reply->count()}}</td>
				<tr>
			@endif	
			@endforeach
			</tbody>
		</table>
		@else
		 There are no threads in this forum yet.
		@endif
    </div>
</div>

@if(Auth::user() && ( !$forum->locked || Auth::user()->role=='admin' ))
<a href='{{ URL::to("uThread/create/$forum->id") }}'>Add Thread</a>
@else
<a href='{{ URL::to("login") }}'>Add Thread</a>
@endif
<br>
<?php echo $threads->links(); ?>

@stop