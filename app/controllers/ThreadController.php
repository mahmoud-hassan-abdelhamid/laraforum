<?php

class ThreadController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$threads=Thread::paginate(5);
		return View::make('threads.index')->with('threads',$threads);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		 $input = array(
		 	'title' => Input::get('thread_title'),
		 	'content' => Input::get('thread_content'),
		 	'forum_id' => Input::get('forum_id')
		 	);

	    $rules = array(
	        'title'=>'required',
	        'content'=>'required',
	        'forum_id'=>'required|numeric'
	    );


	    $validator = Validator::make($input, $rules);

	    if ($validator->fails())
	    {

	        $messages = $validator->messages();

	        return Redirect::to('thread/create')
	            ->withErrors($validator)
	            ->withInput();
	    } 
	    else
	    {
	        $thread = new Thread;
	        $thread->title = Input::get('thread_title');
	        $thread->content    = Input::get('thread_content');
	        $thread->forum_id    = Input::get('forum_id');
	        $thread->user_id    = Auth::user()->id;
	        $thread->save();

	        return Redirect::to('threads');
	    }
	}



	public function uCreate($forum_id)
	{
		$forum=Forum::find($forum_id);

		if(Auth::user() && $forum && ( Auth::user()->role=='admin' || ! $forum->locked)){

			$input = array(
			 	'title' => Input::get('thread_title'),
			 	'content' => Input::get('thread_content')
			 	);

		    $rules = array(
		        'title'=>'required',
		        'content'=>'required'
		    );


		    $validator = Validator::make($input, $rules);

		    if ($validator->fails())
		    {

		        $messages = $validator->messages();

		        return Redirect::to("uThread/create/$forum_id")
		            ->withErrors($validator)
		            ->withInput();
		    } 
		    else
		    {
		        $thread = new Thread;
		        $thread->title = Input::get('thread_title');
		        $thread->content    = Input::get('thread_content');
		        $thread->forum_id    = $forum_id;
		        $thread->user_id    = Auth::user()->id;
		        $thread->save();

		        return Redirect::to("forum/$forum_id/show");
		    }
		}
		else{
			return View::make('home');
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
		 $input = array(
		 	'title' => Input::get('thread_title'),
		 	'content' => Input::get('thread_content'),
		 	'forum_id' => Input::get('forum_id'),
		 	'locked' => Input::get('locked'),
		 	'stickey' => Input::get('stickey')
		 	);

	    $rules = array(
	        'title'=>'required',
	        'content'=>'required',
	        'forum_id'=>'required|numeric',
	        'locked'=>'required|numeric',
	        'stickey'=>'required|numeric'
	    );


	    $validator = Validator::make($input, $rules);

	    if ($validator->fails())
	    {

	        $messages = $validator->messages();

	        return Redirect::to('uThread/$id/edit')
	            ->withErrors($validator)
	            ->withInput();
	    } 
	    else
	    {
	        $thread = Thread::find($id);
	        $thread->title = Input::get('thread_title');
	        $thread->content    = Input::get('thread_content');
	        $thread->forum_id    = Input::get('forum_id');
	        $thread->locked    = Input::get('locked');
	        $thread->stickey    = Input::get('stickey');
	        $thread->save();

	        return Redirect::to('threads');
	    }
	}



	public function uEdit($id)
	{
		 $input = array(
		 	'title' => Input::get('thread_title'),
		 	'content' => Input::get('thread_content'),
		 	);

	    $rules = array(
	        'title'=>'required',
	        'content'=>'required',
	    );


	    $validator = Validator::make($input, $rules);

	    if ($validator->fails())
	    {

	        $messages = $validator->messages();

	        return Redirect::to('uThread/$id/edit')
	            ->withErrors($validator)
	            ->withInput();
	    } 
	    else
	    {
	        $thread = Thread::find($id);
	        $thread->title = Input::get('thread_title');
	        $thread->content    = Input::get('thread_content');
	        $thread->save();

	        return Redirect::to("thread/$thread->id/show");
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
		$thread=Thread::find($id);
		if($thread){
			if(Auth::user() && ( Auth::user()->role=='admin' || $thread->user_id==Auth::user()->id)){
				$thread->delete();
				return Redirect::to('home');
			}
			else{
				return Redirect::to('home');
			}
		}
		else{
			return Redirect::to('home');
		}

	}


	public function lock($id)
	{
		if(Thread::find($id)){
	        $thread = Thread::find($id);
	        if($thread->locked == false){
	        	$thread->locked=true; 
	        }
	        else{
	        	$thread->locked=false;
	        } 
	        $thread->save();
	        return Redirect::to('threads');
	    }
	    else{
			return Redirect::to('home');
		}
	}



	public function stick($id)
	{
		if(Thread::find($id)){
	        $thread = Thread::find($id);
	        if($thread->stickey == false){
	        	$thread->stickey=true; 
	        }
	        else{
	        	$thread->stickey=false;
	        } 
	        $thread->save();
	        return Redirect::to('threads');
	    }
	    else{
			return Redirect::to('home');
		}
	}


}
