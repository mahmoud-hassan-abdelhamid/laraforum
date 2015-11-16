<?php

class ForumController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$forums=Forum::paginate(5);
		return View::make('forums.index')->with('forums',$forums);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		 $input = array(
		 	'name' => Input::get('forum_name'),
		 	'category_id' => Input::get('category_id')
		 	);

	    $rules = array(
	        'name'=>'required',
	        'category_id'=>'required|numeric',
	    );


	    $validator = Validator::make($input, $rules);

	    if ($validator->fails())
	    {

	        $messages = $validator->messages();

	        return Redirect::to('forum/create')
	            ->withErrors($validator)
	            ->withInput();
	    } 
	    else
	    {
	        $forum = new Forum;
	        $forum->name = Input::get('forum_name');
	        $forum->category_id    = Input::get('category_id');
	        $forum->save();

	        return Redirect::to('forums');
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
		$forum=Forum::find($id);
		$threads=Thread::where('forum_id', '=', $id)
		->orderBy('stickey', 'DESC')
		->orderBy('created_at', 'DESC') 
		->paginate(10);
		$data = array(
		    'forum'  => $forum,
		    'threads'   => $threads
		);

		if($forum && $forum->category){
			return View::make('forums.show')->with($data);
		}
		else{
			return View::make('home');
		}
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
		 	'name' => Input::get('forum_name'),
		 	'category_id' => Input::get('category_id'),
		 	'locked' => Input::get('locked')
		 	);

	    $rules = array(
	        'name'=>'required',
	        'category_id'=>'required|numeric',
	        'locked' => 'required|numeric'
	    );

	    $validator = Validator::make($input, $rules);

	    if ($validator->fails())
	    {

	        $messages = $validator->messages();

	        return Redirect::to("forum/$id/edit")
	            ->withErrors($validator)
	            ->withInput();
	    } 
	    else
	    {
	        $forum = Forum::find($id);
	        $forum->name = Input::get('forum_name');
	        $forum->category_id = Input::get('category_id');
	        $forum->locked = Input::get('locked');
	        $forum->save();

	        return Redirect::to('forums');
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
		if(Forum::find($id)){
			Forum::find($id)->delete();
			return Redirect::to('forums');
		}
		else{
			return Redirect::to('home');
		}
	}


	public function lock($id)
	{
		if(Forum::find($id)){
	        $forum = Forum::find($id);
	        if($forum->locked == false){
	        	$forum->locked=true; 
	        }
	        else{
	        	$forum->locked=false;
	        } 
	        $forum->save();
	        return Redirect::to('forums');
	    }
	    else{
			return Redirect::to('home');
		}
	}


}
