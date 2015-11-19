@extends('layouts.main')
@section('content')

<div class="panel panel-primary">
  <div class="panel-heading forum-heading">{{ $thread->title }} <span class="pull-right">{{ $thread->created_at }}</span></div>
    <div class="panel-body">
    	<div class="container">
    		<div class="col-md-3">
    			<a href='{{ URL::to("user/$thread->user_id/viewProfile") }}'> {{ $thread->user->email }} </a><br><br>
    			<?php $user=$thread->user; ?>
    			<a href='{{ URL::to("user/$thread->user_id/viewProfile") }}'> 
		    				@if ($user->pic)
		    				<img class="img-responsive img-thumbnail" style="width:50% !important;" src='{{URL::asset("usersPics/$user->pic")}}'/> 
		    				@else
		    				<img class="img-responsive img-thumbnail" style="width:50% !important;" src='{{URL::asset("usersPics/no.jpg")}}'/> 
		    				@endif
		    	</a><br>

    		</div>
    		<div class="col-md-9">
@if(Auth::user() && ( Auth::user()->role=='admin' || Auth::user()->id == $thread->user_id ))

					<a style="float:left;" href="{{route('Thread.uEdit', $thread->id)}}" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span></a> 

                    {{ Form::open(array('method' => 'DELETE', 'action' => array('ThreadController@destroy', $thread->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-bin"></span>',array ('type'=>'submit','class'=>'btn btn-danger', 'onclick'=>'return confirm("Are You Sure?")'))}}
                    {{Form::close()}}

@endif
    		 {{ $thread->content }} 

    		</div>
    	</div>
    </div>
</div>

@if($thread->reply->count() >0 )

<div class="panel panel-primary">
  <div class="panel-heading forum-heading">Replies</div>
    <div class="panel-body">


@foreach($thread->reply as $reply)
		<div class="panel panel-primary">
		  <div class="panel-heading forum-heading">{{ $reply->title }} <span class="pull-right">{{ $reply->created_at }}</span></div>
		    <div class="panel-body">
		    	<div class="container">
		    		<div class="col-md-3">
		    			<a href='{{ URL::to("user/$thread->user_id/viewProfile") }}'> {{ $reply->user->email }} </a><br><br>
		    			<?php $reply_user=$reply->user; ?>
		    			<a href='{{ URL::to("user/$reply->user_id/viewProfile") }}'>
		    				@if ($reply_user->pic)
		    				<img class="img-responsive img-thumbnail" style="width:50% !important;" src='{{URL::asset("usersPics/$reply_user->pic")}}'/> 
		    				@else
		    				<img class="img-responsive img-thumbnail" style="width:50% !important;" src='{{URL::asset("usersPics/no.jpg")}}'/> 
		    				@endif
		    			</a><br>

		    		</div>
		    		<div class="col-md-9">
		    		
					@if(Auth::user() && ( Auth::user()->role=='admin' || Auth::user()->id == $reply->user_id ))

										<a style="float:left;" href="{{route('Reply.edit', $reply->id)}}" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span></a> 

					                    {{ Form::open(array('method' => 'DELETE', 'action' => array('ReplyController@destroy', $reply->id))) }}
					                    {{Form::button('<span class="glyphicon glyphicon-bin"></span>',array ('type'=>'submit','class'=>'btn btn-danger', 'onclick'=>'return confirm("Are You Sure?")'))}}
					                    {{Form::close()}}

					@endif

		    		{{ $reply->content }} 

		    	</div>
		    	</div>
		    </div>
		</div>

@endforeach

    </div>
</div>



@else
There Are No Replies Yet. <br><br>
@endif

@if(Auth::user() && ( !$thread->locked || Auth::user()->role=='admin' ))
<a href='{{ URL::to("reply/create/$thread->id") }}'>Add Reply</a>
@else
<a href='{{ URL::to("login") }}'>Add Reply</a>
@endif



@stop