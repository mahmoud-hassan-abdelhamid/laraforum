
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


    {{Form::open(array('files'=>true ))}}

        <div class="form-group">

            {{Form::label('email','Email')}}
            {{Form::email('email', null, array('class'=>'form-control'))}}

        </div>

		<div class="form-group">
		    {{Form::label('password', 'Password')}}
		    {{Form::password('password', array('class'=>'form-control'))}}
		</div>

		<div class="form-group">
		    {{Form::label('password_confirmation', 'Password confirmation')}}
		    {{Form::password('password_confirmation', array('class'=>'form-control'))}}
		</div>

		<div class="form-group">
		    {{Form::label('pic', 'Upload Pic')}}
		    {{Form::file('pic', array('class'=>'form-control'))}}
		</div>

		<div class="form-group">
		    {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
		</div>

    {{Form::close()}}


@stop