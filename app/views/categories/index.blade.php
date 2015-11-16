@extends('layouts.main')
@section('content')

<a href="{{URL::to('category/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create Category</a> <br><br>
<table class="table table-hover table-responsive table-striped cat-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Number Of Forums</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($categories as $category)
			<tr>
				<td> {{$category->id}} </td>
				<td> {{$category->name}} </td>
				<td> {{$category->forum->count()}} </td>
				<td>
					<a href="{{route('Category.edit', $category->id)}}" class="btn btn-primary" style="float:left; margin-right:5px;"> <span class="glyphicon glyphicon-edit"></span></a>

                    {{ Form::open(array('method' => 'DELETE', 'action' => array('CategoryController@destroy', $category->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-bin"></span>',array ('type'=>'submit','class'=>'btn btn-danger', 'onclick'=>'return confirm("Are You Sure?")'))}}
                    {{Form::close()}}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<?php echo $categories->links(); ?>

@stop