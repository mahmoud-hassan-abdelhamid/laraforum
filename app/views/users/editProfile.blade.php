
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
            {{Form::email('email', $user->email, array('class'=>'form-control'))}}

        </div>

		<div class="form-group">
		    {{Form::label('Current Pic')}}
		    @if($user->pic)
		    <img style="max-width:15%; max-height:15%;" src='{{URL::asset("usersPics/$user->pic")}}' />
		    @else
		    <img style="max-width:15%; max-height:15%;" src='{{URL::asset("usersPics/no.jpg")}}' />
			@endif
		</div>

		<div class="form-group">
		    {{Form::label('pic', 'Change Pic')}}
		    {{Form::file('pic', array('class'=>'form-control'))}}
		</div>


		<div class="form-group">
		    {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
		</div>

    {{Form::close()}}


@stop