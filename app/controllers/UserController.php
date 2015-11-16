<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$users=User::paginate(5);
		return View::make('users.index')->with('users',$users); 
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
			$input = array(
		 	'email' => Input::get('email'),
		 	'password' => Input::get('password'),
		 	'password_confirmation' => Input::get('password_confirmation'),
		 	'pic' => Input::file('pic')
		 	);

	    $rules = array(
	        'email'=>'required|email|unique:user',
	        'password' => 'required|min:3|confirmed',
	        'password_confirmation' => 'required|min:3',
	        'pic' => 'image'
	    );


	    $validator = Validator::make($input, $rules);

	    if ($validator->fails())
	    {

	        $messages = $validator->messages();

	        return Redirect::to('user/create')
	            ->withErrors($validator)
	            ->withInput();
	    } 
	    else
	    {
	        $user = new User;
	        $user->email    = Input::get('email');
	        $user->password = Hash::make(Input::get('password'));
			if(Input::hasFile('pic')){
				$dest='usersPics/';
				$imgName=str_random(6).'.'.Input::file('pic')->getClientOriginalExtension();
				Input::file('pic')->move($dest,$imgName);
				$user->pic = $imgName;
			}
	        $user->save();

	        return Redirect::to('users');
	    }
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
			if (User::find($id)->email == Input::get('email')){
				$rules = array(
		        'email'=>'required|email',
		        'pic' => 'image'  
			    );
			}
			else{
				$rules = array(
		        'email'=>'required|email|unique:user',
		        'pic' => 'image'  
			    );
			}


		    $input = array(
			 	'email' => Input::get('email'),
			 	'pic' => Input::file('pic'),
		 	);


		    $validator = Validator::make($input, $rules);

		    if ($validator->fails())
		    {

		        $messages = $validator->messages();

		        return Redirect::to("user/$id/edit")
		            ->withErrors($validator)
		            ->withInput();
		    } 
		    else
		    {
		        $user = User::find($id);
		        $user->email    = Input::get('email');
		        $user->banned   = Input::get('banned');
		        $user->role   = Input::get('role');
				if(Input::hasFile('pic')){
					$dest='usersPics/';
					$imgName=str_random(6).'.'.Input::file('pic')->getClientOriginalExtension();
					Input::file('pic')->move($dest,$imgName);
					$user->pic = $imgName;
				}
		        $user->save();

		        return Redirect::to('users');
		    }

}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(User::find($id)){
			User::find($id)->delete();
			return Redirect::to('users');
		}
		else {
			return Redirect::to('home');
		}
	}

	public function register()
	{
		 $input = array(
		 	'email' => Input::get('email'),
		 	'password' => Input::get('password'),
		 	'password_confirmation' => Input::get('password_confirmation'),
		 	'pic' => Input::file('pic')
		 	);

	    $rules = array(
	        'email'=>'required|email|unique:user',
	        'password' => 'required|min:3|confirmed',
	        'password_confirmation' => 'required|min:3',
	        'pic' => 'image'
	    );


	    $validator = Validator::make($input, $rules);

	    if ($validator->fails())
	    {

	        $messages = $validator->messages();

	        return Redirect::to('register')
	            ->withErrors($validator)
	            ->withInput();
	    } 
	    else
	    {
	        $user = new User;
	        $user->email    = Input::get('email');
	        $user->password = Hash::make(Input::get('password'));
			if(Input::hasFile('pic')){
				$dest='usersPics/';
				$imgName=str_random(6).'.'.Input::file('pic')->getClientOriginalExtension();
				Input::file('pic')->move($dest,$imgName);
				$user->pic = $imgName;
			}
	        $user->save();

	        return Redirect::to('login');
	    }
	}

	public function login(){

		$credentials = [
		   "email" => Input::get("email"),
		   "password" => Input::get("password"),
		   "banned" => 0
		];

		if (Auth::attempt($credentials)) {
		    return Redirect::to('home');
		}

		else {
		    return Redirect::to('login')
		        ->with('message', 'Your email/password combination was incorrect')
		        ->withInput();
		}
	}


	public function viewProfile($id)
	{
		$user=User::find($id);
		if ($user){
			return View::make('users.profile')
			->with('user', $user);
		}
		else{
			return View::make('home');
		}
	}


	public function editProfile($id)
	{
		if(User::find($id) && Auth::user() && (Auth::user()->id == $id || Auth::user()->role=='admin')){
				
			if (User::find($id)->email == Input::get('email')){
				$rules = array(
		        'email'=>'required|email',
		        'pic' => 'image'  
			    );
			}
			else{
				$rules = array(
		        'email'=>'required|email|unique:user',
		        'pic' => 'image'  
			    );
			}


		    $input = array(
			 	'email' => Input::get('email'),
			 	'pic' => Input::file('pic'),
		 	);


		    $validator = Validator::make($input, $rules);

		    if ($validator->fails())
		    {

		        $messages = $validator->messages();

		        return Redirect::to("user/$id/editProfile")
		            ->withErrors($validator)
		            ->withInput();
		    } 
		    else
		    {
		        $user = User::find($id);
		        $user->email    = Input::get('email');
				if(Input::hasFile('pic')){
					$dest='usersPics/';
					$imgName=str_random(6).'.'.Input::file('pic')->getClientOriginalExtension();
					Input::file('pic')->move($dest,$imgName);
					$user->pic = $imgName;
				}
		        $user->save();

		        return Redirect::to("user/$id/viewProfile");
		    }
		}
		else
				return View::make('home');

	}

	public function ban($id){
		if(User::find($id)){
	        $user = User::find($id);
	        if($user->banned == false){
	        	$user->banned=true; 
	        }
	        else{
	        	$user->banned=false;
	        } 
	        $user->save();
	        return Redirect::to('users');
	    }
	    else{
			return Redirect::to('home');
		}
	}

	public function changeRole($id){
		if(User::find($id)){
	        $user = User::find($id);
	        if($user->role == 'admin'){
	        	$user->role='user'; 
	        }
	        else{
	        	$user->role='admin';
	        } 
	        $user->save();
	        return Redirect::to('users');
	    }
	    else{
			return Redirect::to('home');
		}
	}


}
