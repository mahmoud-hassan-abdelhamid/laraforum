<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('home', function()
{
	return View::make('home'); 
});
Route::get('/', function()
{
	return View::make('home'); 
});


Route::group(array('before' => 'loggedIn'), function()
{

	Route::get('logout', function()
	{
			Auth::logout();
			return View::make('home'); 
		
	});

});


Route::group(array('before' => 'notLoggedIn'), function()
{

Route::get('register', function()
{
		return View::make('register'); 
});

Route::post('register', 'UserController@register');

Route::get('login', function()
{
		return View::make('login'); 
});

Route::post('login', 'UserController@login');

});



Route::group(array('before' => 'isAdmin'), function()
{

	/////////Users///////////

	Route::get('users', 'UserController@index');

	Route::get('user/{id}/edit', function($id)
	{
		if(User::find($id)){
			$user=User::find($id);
			return View::make('users.edit')->with('user',$user); 
		} 
		else{
			return View::make('home');
		}
	});

	Route::post('user/{id}/edit', array(
	    'uses' => 'UserController@edit',
	    'as' => 'User.edit'
	));

	Route::post('user/{id}/ban', array(
	    'uses' => 'UserController@ban',
	    'as' => 'User.ban'
	));

	Route::post('user/{id}/changeRole', array(
	    'uses' => 'UserController@changeRole',
	    'as' => 'User.changeRole'
	));

	Route::delete('user/{id}/destroy', array(
    'uses' => 'UserController@destroy',
    'as' => 'User.destroy'
	));


	Route::get('user/create', function()
	{
			return View::make('users.create'); 
	});

	Route::post('user/create', 'UserController@create');



    /////////Categories///////////

	Route::get('categories', 'CategoryController@index');


	Route::get('category/{id}/edit', function($id)
	{
		$category=Category::find($id);
		if($category){
			return View::make('categories.edit')->with('category',$category);  
		} 
		else{
			return View::make('home');
		}

	});

	Route::post('category/{id}/edit', array(
	    'uses' => 'CategoryController@edit',
	    'as' => 'Category.edit'
	));

	Route::delete('category/{id}/destroy', array(
    'uses' => 'CategoryController@destroy',
    'as' => 'Category.destroy'
	));


	Route::get('category/create', function()
	{
			return View::make('categories.create'); 
	});

	Route::post('category/create', 'CategoryController@create');


	//////////Forums///////////////


	Route::get('forums', 'ForumController@index');


	Route::get('forum/{id}/edit', function($id)
	{
			$forum=Forum::find($id);
			if($forum){
			return View::make('forums.edit')->with('forum',$forum); 
			}
			else{
			return View::make('home');
			} 

	});

	Route::post('forum/{id}/edit', array(
	    'uses' => 'ForumController@edit',
	    'as' => 'Forum.edit'
	));

	Route::delete('forum/{id}/destroy', array(
    'uses' => 'ForumController@destroy',
    'as' => 'Forum.destroy'
	));

	Route::post('forum/{id}/lock', array(
    'uses' => 'ForumController@lock',
    'as' => 'Forum.lock'
	));

	Route::get('forum/create', function()
	{
			return View::make('forums.create'); 
	});

	Route::post('forum/create', 'ForumController@create');


	///////////////Threads///////////////////


	Route::get('threads', 'ThreadController@index');

	Route::get('thread/{id}/edit', function($id)
	{
			$thread=Thread::find($id);
			if($thread){
			return View::make('threads.edit')->with('thread',$thread); 
			}
			else{
			return View::make('home');
			} 

	});

	Route::post('thread/{id}/edit', array(
	    'uses' => 'ThreadController@edit',
	    'as' => 'Thread.edit'
	));

	Route::delete('thread/{id}/destroy', array(
    'uses' => 'ThreadController@destroy',
    'as' => 'Thread.destroy'
	));

	Route::post('thread/{id}/lock', array(
    'uses' => 'ThreadController@lock',
    'as' => 'Thread.lock'
	));

	Route::post('thread/{id}/stick', array(
    'uses' => 'ThreadController@stick',
    'as' => 'Thread.stick'
	));

	Route::get('thread/create', function()
	{
		return View::make('threads.create'); 
	});

	Route::post('thread/create', 'ThreadController@create');

});



	Route::get('user/{id}/viewProfile', 'UserController@viewProfile');


	Route::get('user/{id}/editProfile', function($id)
	{
			$user=User::find($id);
			if(Auth::user() && (Auth::user()->id == $id || Auth::user()->role=='admin') && $user){
				
				return View::make('users.editProfile')->with('user',$user);  
			}
			else
				return View::make('home');

	});

Route::post('user/{id}/editProfile', 'UserController@editProfile');

Route::get('forum/{id}/show', 'ForumController@show');


	/////////////////////Replies/////////////////////

	//Route::get('replies', 'ReplyController@index');


	Route::get('reply/{id}/edit', function($id)
	{
		$reply=Reply::find($id);
			if(Auth::user() && ( Auth::user()->role=='admin' || $reply->user_id==Auth::user()->id)){
			return View::make('replies.edit')->with('reply',$reply); 
			}
			else{
			return View::make('home');
			} 

	});

	Route::post('reply/{id}/edit', array(
	    'uses' => 'ReplyController@edit',
	    'as' => 'Reply.edit'
	));

	Route::delete('reply/{id}/destroy', array(
    'uses' => 'ReplyController@destroy',
    'as' => 'Reply.destroy'
	));

	Route::get('reply/create/{thread_id}', function($thread_id)
	{	
		$thread=Thread::find($thread_id);
		if(Auth::user() && ( Auth::user()->role=='admin' || !$thread->locked)){
			if($thread ){
				return View::make('replies.create'); 
			}
			else{
				return View::make('home');
			}
	    } 
		else{
			return View::make('home');
		} 

	});

	Route::post('reply/create/{thread_id}', 'ReplyController@create');


	//////////////////////////////User Threads/////////////////


	Route::get('uThread/{id}/edit', function($id)
	{
		$thread=Thread::find($id);
			if(Auth::user() && ( Auth::user()->role=='admin' || $thread->user_id==Auth::user()->id)){
				return View::make('threads.uEdit')->with('thread',$thread); 
			}
			else{
				return View::make('home');
			} 

	});

	Route::post('uThread/{id}/edit', array(
	    'uses' => 'ThreadController@uEdit',
	    'as' => 'Thread.uEdit'
	));

	Route::delete('thread/{id}/destroy', array(
    'uses' => 'ThreadController@destroy',
    'as' => 'Thread.destroy'
	));

	Route::get('uThread/create/{forum_id}', function($forum_id)
	{	
		$forum=Forum::find($forum_id);

		if(Auth::user() && $forum && ( Auth::user()->role=='admin' || ! $forum->locked)){
			return View::make('threads.uCreate'); 
		}

		else{
			return View::make('home');
		} 

	});

	Route::post('uThread/create/{forum_id}', 'ThreadController@uCreate');


	Route::get('thread/{id}/show', function($id)
	{
		$thread=Thread::find($id);
			if($thread){
				return View::make('threads.show')->with('thread',$thread); 
			}
			else{
				return View::make('home');
			} 

	});

	App::missing(function($exception)
	{
	    return View::make('404');
	});