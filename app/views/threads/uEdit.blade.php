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


        {{Form::open()}}

        <div class="form-group">

            {{Form::label('thread_title','Thread Title')}}
            {{Form::text('thread_title', $thread->title , array('class'=>'form-control','placeholder'=>'Thread Title'))}}

        </div>

         <div class="form-group">

            {{Form::label('thread_content','Thread Content')}}
            {{Form::textarea('thread_content', $thread->content, array('class'=>'form-control','placeholder'=>'Thread Content'))}}

        </div>

        <div class="form-group">
            {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
        </div>

    {{Form::close()}}


@stop