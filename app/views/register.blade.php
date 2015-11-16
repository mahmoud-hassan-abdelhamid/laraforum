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
<div class="col-md-3"></div>
<div class="col-md-6" id="log-reg-form">
  <h1 id="log-reg-header"> Register</h1> <br>

    {{Form::open(array('files'=>true ))}}

        <div class="form-group">

            {{Form::label('email','Email*')}}
            {{Form::email('email', null, array('class'=>'form-control','placeholder'=>'Email'))}}

        </div>

		<div class="form-group">
		    {{Form::label('password', 'Password*')}}
		    {{Form::password('password', array('class'=>'form-control','placeholder'=>'Password'))}}
		</div>

		<div class="form-group">
		    {{Form::label('password_confirmation', 'Password Confirmation*')}}
		    {{Form::password('password_confirmation', array('class'=>'form-control','placeholder'=>'Password Confirmation'))}}
		</div>

		<div class="form-group">
		    {{Form::label('pic', 'Upload Your Pic')}}
		    {{Form::file('pic', array('class'=>'form-control'))}}
		</div>

		<div class="form-group">
		    {{Form::submit('Submit', array('class'=>'btn btn-primary col-xs-12'))}}
		</div>

    {{Form::close()}}
</div>
<div class="col-md-3"></div>
@stop