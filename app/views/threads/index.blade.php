@extends('layouts.main')
@section('content')

<a href="{{URL::to('thread/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create Thread</a> <br><br>
<table class="table table-hover table-responsive table-striped cat-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>By</th>
			<th>Forum</th>
			<th>Number Of Replies</th>
			<th>Locked?</th>
			<th>Sticky?</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($threads as $thread)
			<tr>
				<td> {{$thread->id}} </td>
				<td> <a href='{{ URL::to("thread/$thread->id/show") }}'>{{$thread->title}}</a></td>
				<td> <a href='{{ URL::to("user/$thread->user_id/viewProfile") }}'>{{$thread->user->email}}</a></td>
				@if($thread->forum)
				<td><a href='{{ URL::to("forum/$thread->forum_id/show") }}'> {{$thread->forum->name}} </a> </td> 
				@else 
				<td> No Forum </td>
				@endif
				<td> {{$thread->reply->count()}} </td>
				<td> @if($thread->locked) Yes @else No @endif</td>
				<td> @if($thread->stickey) Yes @else No @endif</td>
				<td>
					<a href="{{route('Thread.edit', $thread->id)}}" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span></a>

                    {{ Form::open(array('method' => 'POST', 'action' => array('ThreadController@lock', $thread->id))) }}
                    @if($thread->locked)
                    {{Form::button('<span class="glyphicon glyphicon-unlock"></span>',array ('type'=>'submit','class'=>'btn btn-primary'))}}
                    @else
                    {{Form::button('<span class="glyphicon glyphicon-lock"></span>',array ('type'=>'submit','class'=>'btn btn-primary'))}}
                    @endif
                    {{Form::close()}}

                     {{ Form::open(array('method' => 'POST', 'action' => array('ThreadController@stick', $thread->id))) }}
                    @if($thread->stickey)
                    {{Form::button('<span class="glyphicon glyphicon-scissors"></span>',array ('type'=>'submit','class'=>'btn btn-primary'))}}
                    @else
                    {{Form::button('<span class="glyphicon glyphicon-pushpin"></span>',array ('type'=>'submit','class'=>'btn btn-primary'))}}
                    @endif
                    {{Form::close()}}

                    {{ Form::open(array('method' => 'DELETE', 'action' => array('ThreadController@destroy', $thread->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-bin"></span>',array ('type'=>'submit','class'=>'btn btn-danger', 'onclick'=>'return confirm("Are You Sure?")'))}}
                    {{Form::close()}}

				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<?php echo $threads->links(); ?>

@stop