@extends('layouts.main')
@section('content')

@if(Session::has('message'))
<div class="panel panel-danger">
  <div class="panel-heading"></div>
  <div class="panel-body">
   {{ Session::get('message') }}
  </div>
</div>
@endif
<div class="col-md-3"></div>
<div class="col-md-6" id="log-reg-form">
  <h1 id="log-reg-header"> Log In</h1> <br>
    {{Form::open(array('class'=>'form-horizontal'))}}

        <div class="form-group">

            {{Form::label('email','Email',array('class'=>'control-label col-sm-2'))}}
            <div class="col-sm-10">
            <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            {{Form::email('email', null, array('class'=>'form-control','placeholder'=>'Email'))}}
            </div>
            </div>

        </div>

		<div class="form-group">
		    {{Form::label('password', 'Password',array('class'=>'control-label col-sm-2'))}}
        <div class="col-sm-10">
        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
		    {{Form::password('password', array('class'=>'form-control','placeholder'=>'Password'))}}
        </div>
        </div>
		</div>

		<div class="form-group">
        {{Form::label('', '',array('class'=>'control-label col-sm-2'))}}
        <div class="col-sm-10">
		    {{Form::submit('Submit', array('class'=>'btn btn-primary form-control'))}}
        </div>
		</div>

    {{Form::close()}}

</div>
<div class="col-md-3"></div>
@stop