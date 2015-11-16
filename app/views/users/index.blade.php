@extends('layouts.main')

@section('content')
<a href="{{URL::to('user/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create User</a> <br><br>
<table class="table table-hover table-responsive table-striped cat-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Email</th>
			<th>Role</th>
			<th>Banned?</th>
			<th>Pic</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
		@if($user->id != Auth::user()->id)
			<tr>
				<td> {{$user->id}} </td>
				<td> {{$user->email}} </td>
				<td> {{$user->role}} </td>
				<td>@if($user->banned==1) Yes
					@else No
					@endif
				</td>

				<td> @if ($user->pic != null)
						 <img style="max-width:70px; max-height:70px;" src='{{URL::asset("usersPics/$user->pic")}}' />
					 @else
						<img style="max-width:70px; max-height:70px;" src='{{URL::asset("usersPics/no.jpg")}}' />
					 @endif
				  </td>
				<td>
					<a href="{{route('User.edit', $user->id)}}" class="btn btn-primary" style="float:left; margin-right:5px;"> <span class="glyphicon glyphicon-edit"></span></a>
                    
                    @if($user->banned==false)
                    {{Form::open(array('method' => 'POST', 'action' => array('UserController@ban', $user->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-ban"></span>',array ('type'=>'submit','class'=>'btn btn-danger'))}}
                    {{Form::close()}}
					@else
					{{Form::open(array('method' => 'POST', 'action' => array('UserController@ban', $user->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-ok"></span>',array ('type'=>'submit','class'=>'btn btn-primary'))}}
                    {{Form::close()}}
                    @endif
                   
                    @if($user->role=='user')
                    {{Form::open(array('method' => 'POST', 'action' => array('UserController@changeRole', $user->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-group"></span>',array ('type'=>'submit','class'=>'btn btn-primary'))}}
                    {{Form::close()}}
					@else
                    {{Form::open(array('method' => 'POST', 'action' => array('UserController@changeRole', $user->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-user"></span>',array ('type'=>'submit','class'=>'btn btn-primary'))}}
                    {{Form::close()}}
                    @endif

                    {{ Form::open(array('method' => 'DELETE', 'action' => array('UserController@destroy', $user->id))) }}
                    {{Form::button('<span class="glyphicon glyphicon-bin"></span>',array ('type'=>'submit','class'=>'btn btn-danger', 'onclick'=>'return confirm("Are You Sure?")'))}}
                    {{Form::close()}}
				</td>
			</tr>
		@endif
		@endforeach
	</tbody>
</table>

  

<?php echo $users->links(); ?>

@stop