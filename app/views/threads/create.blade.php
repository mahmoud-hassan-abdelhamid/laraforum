@extends('layouts.main')
@section('content')

@if ($errors->any())
<div class="panel panel-danger">
  <div class="panel-heading">Please Fix The Errors</div>
  <div class="panel-body">
    {{ implode('', $errors->all('<h5>:message</h5>')) }}
  </div>
</div>

@endif

<?php $forums = Forum::lists('name', 'id'); ?>
    {{Form::open()}}

        <div class="form-group">

            {{Form::label('thread_title','Thread Title')}}
            {{Form::text('thread_title', null, array('class'=>'form-control','placeholder'=>'Thread Title'))}}

        </div>

        <div class="form-group">

            {{Form::label('thread_content','Thread Content')}}
            {{Form::textarea('thread_content', null, array('class'=>'form-control','placeholder'=>'Thread Content'))}}

        </div>


        <div class="form-group">
            {{Form::label('forum_id','Forum')}}
            {{ Form::select('forum_id', $forums,array('class'=>'form-control')) }}
        </div>

    		<div class="form-group">
    		    {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
    		</div>

    {{Form::close()}}


@stop