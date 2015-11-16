<?php

class ReplyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		/*
		$replies=Reply::paginate(5);
		return View::make('replies.index')->with('replies',$replies);
		*/
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($thread_id)
	{
		$thread=Thread::find($thread_id);
		if(Auth::user() && $thread && ( Auth::user()->role=='admin' || !$thread->locked)){
			$input = array(
			 	'title' => Input::get('reply_title'),
			 	'content' => Input::get('reply_content'),
			 	);

		    $rules = array(
		        'title'=>'required',
		        'content'=>'required',
		    );


		    $validator = Validator::make($input, $rules);

		    if ($validator->fails())
		    {

		        $messages = $validator->messages();

		        return Redirect::to("reply/create/$thread_id")
		            ->withErrors($validator)
		            ->withInput();
		    } 
		    else
		    {
		        $reply = new Reply;
		        $reply->title = Input::get('reply_title');
		        $reply->content = Input::get('reply_content');
		        $reply->thread_id = $thread_id;
		        $reply->user_id = Auth::user()->id;
		        $reply->save();

		        return Redirect::to("thread/$thread_id/show");
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
		if(Auth::user() && ( Auth::user()->role=='admin' || $reply->user_id==Auth::user()->id)){

			 $input = array(
			 	'title' => Input::get('reply_title'),
			 	'content' => Input::get('reply_content'),
			 	);

		    $rules = array(
		        'title'=>'required',
		        'content'=>'required',
		    );


		    $validator = Validator::make($input, $rules);

		    if ($validator->fails())
		    {

		        $messages = $validator->messages();

		        return Redirect::to("reply/$id/edit")
		            ->withErrors($validator)
		            ->withInput();
		    } 
		    else
		    {
		        $reply =Reply::find($id);
		        $reply->title = Input::get('reply_title');
		        $reply->content    = Input::get('reply_content');
		        $reply->save();

		        return Redirect::to("thread/$reply->thread_id/show");
		    }
		}
		else{
			return View::make('home');
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
		$reply=Reply::find($id);
		if(Auth::user() && (Auth::user()->role=='admin' || $reply->user_id == Auth::user()->id )){
			$reply->delete();
			return Redirect::to("thread/$reply->thread_id/show");
		}
		else{
			return Redirect::to('home');
		}
		
	}


}
