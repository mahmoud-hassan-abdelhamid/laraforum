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

<?php $categories = Category::lists('name', 'id'); ?>
    {{Form::open()}}

        <div class="form-group">

            {{Form::label('forum_name','Forum Name')}}
            {{Form::text('forum_name', null, array('class'=>'form-control','placeholder'=>'Forum Name'))}}

        </div>

        <div class="form-group">

            {{Form::label('category_id','Category')}}
            {{ Form::select('category_id', $categories,array('class'=>'form-control')) }}
        </div>

    		<div class="form-group">
    		    {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
    		</div>

    {{Form::close()}}


@stop