@extends('layouts.main')
@section('content')

<a href="{{URL::to('forum/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create Forum</a> <br><br>
<table class="table table-hover table-responsive table-striped cat-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Category</th>
			<th>Number Of Threads</th>
			<th>Locked?</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($forums as $forum)
			<tr>
				<td> {{$forum->id}} </td>
				<td> <a href='{{ URL::to("forum/$forum->id/show") }}'>{{$forum->name}}</a></td>
				@if($forum->category)<td> {{$forum->category->name}} </td> 
				@else <td> No Category </td>
				@endif
				<td> {{$forum->thread->count()}} </td>
				<td> @if($forum->locked) Yes @else No @endif</td>
				<td>
					<a href="{{route('Forum.edit', $forum->id)}}" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span></a>

                    {{ Form::open(array('method' => 'POST', 'action' => array('ForumController@lock', $forum->id))) }}
                    @if($forum->locked)
                    {{Form::button('<span class="glyphicon glyphicon-unlock"></span>',array ('type'=>'submit','class'=>'btn btn-primary'))}}
                    @else
                    {{Form::button('<span class="glyphicon glyphicon-lock"></span>',array ('type'=>'submit','class'=>'btn btn-primary'))}}
                    @endif
                    {{Form::close()}}

                    {{ Form::open(array('method' => 'DELETE', 'action' => array('ForumController@destroy', $forum->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-bin"></span>',array ('type'=>'submit','class'=>'btn btn-danger', 'onclick'=>'return confirm("Are You Sure?")'))}}
                    {{Form::close()}}

				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<?php echo $forums->links(); ?>

@stop