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

<?php  $forums = Forum::lists('name', 'id'); ?>

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

          {{Form::label('current_forum','Current Forum: ')}} 
          @if($thread->forum) {{$thread->forum->name}}
          @else No Forum
          @endif

        </div>

        <div class="form-group">

            {{Form::label('forum_id','Change Forum?')}}
            {{Form::select('forum_id', $forums,array('class'=>'form-control')) }}
        </div>

        <div class="form-group">
            {{Form::label('locked', 'Locked?')}}
            @if ($thread->locked)
            Yes{{Form::radio('locked', 1,array('checked'=>'checked'))}}
            No {{Form::radio('locked', 0)}}
            @else
            Yes{{Form::radio('locked', 1)}}
            No {{Form::radio('locked', 0,array('checked'=>'checked'))}}
            @endif
        </div>

        <div class="form-group">
            {{Form::label('stickey', 'Stickey?')}}
            @if ($thread->stickey)
            Yes{{Form::radio('stickey', 1,array('checked'=>'checked'))}}
            No {{Form::radio('stickey', 0)}}
            @else
            Yes{{Form::radio('stickey', 1)}}
            No {{Form::radio('stickey', 0,array('checked'=>'checked'))}}
            @endif
        </div>

        <div class="form-group">
            {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
        </div>

    {{Form::close()}}


@stop