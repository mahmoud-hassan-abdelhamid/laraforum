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

            {{Form::label('reply_title','Reply Title')}}
            {{Form::text('reply_title', null, array('class'=>'form-control','placeholder'=>'Reply Title'))}}

        </div>

        <div class="form-group">

            {{Form::label('reply_content','Reply Content')}}
            {{Form::textarea('reply_content', null, array('class'=>'form-control','placeholder'=>'Reply Content'))}}

        </div>


    		<div class="form-group">
    		    {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
    		</div>

    {{Form::close()}}


@stop