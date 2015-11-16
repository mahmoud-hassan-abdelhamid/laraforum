@extends('layouts.main')
@section('content')

<a href="{{URL::to('reply/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create Reply</a> <br><br>
<table class="table table-hover table-responsive table-striped cat-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>By</th>
			<th>Thread</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($replies as $reply)
			<tr>
				<td> {{$reply->id}} </td>
				<td> {{$reply->title}}</td>
				<td> <a href='{{ URL::to("user/$reply->user_id/viewProfile") }}'>{{$reply->user->email}}</a></td>
				@if($reply->thread)
				<td><a href='{{ URL::to("thread/$reply->thread_id/show") }}'> {{$reply->thread->title}} </a> </td> 
				@else 
				<td> No Thread </td>
				@endif
				<td>
					<a href="{{route('Reply.edit', $reply->id)}}" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span></a>

                    {{ Form::open(array('method' => 'DELETE', 'action' => array('ReplyController@destroy', $reply->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-bin"></span>',array ('type'=>'submit','class'=>'btn btn-danger', 'onclick'=>'return confirm("Are You Sure?")'))}}
                    {{Form::close()}}

				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<?php echo $replies->links(); ?>

@stop