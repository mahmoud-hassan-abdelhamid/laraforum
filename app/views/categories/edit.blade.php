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

            {{Form::label('cat_name','Category Name')}}
            {{Form::text('cat_name', $category->name, array('class'=>'form-control','placeholder'=>'Category Name'))}}

        </div>


		<div class="form-group">
		    {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
		</div>

    {{Form::close()}}


@stop