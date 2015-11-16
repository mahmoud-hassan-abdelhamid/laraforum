@extends('layouts.main')
@section('content')

<?php $categories=Category::all(); ?>

@foreach ($categories as $category)
@if ($category->forum->count()>0 )
<div class="panel panel-primary">
  <div class="panel-heading category-heading">{{ $category->name }}</div>
    <div class="panel-body">
  		<table class="table">
	 		<thead>
	 			<th>Forum Name</th>
	 			<th>Number Of Threads</th>
	 			<th>Number Of Replies</th>
	 		</thead>
	 		<tbody> 			
		  	@foreach ($category->forum as $category_forum)
			  	<tr>
				  	<td><a href='{{ URL::to("forum/$category_forum->id/show") }}'>{{$category_forum->name}}</a></td>
				  	<td>{{$category_forum->thread->count()}}</td>
				  		<?php $no_of_forum_replies=0; ?>
				  		@foreach($category_forum->thread as $forum_thread)
				  			<?php $no_of_forum_replies+=$forum_thread->reply->count(); ?>
				  		@endforeach
					<td>{{$no_of_forum_replies}}</td>
				<tr>		
			@endforeach
			</tbody>
		</table>
    </div>
</div>
@endif
@endforeach

@stop