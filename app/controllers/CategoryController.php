<?php

class CategoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories=Category::paginate(5);
		return View::make('categories.index')->with('categories',$categories);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    $input = array(
		 	'name' => Input::get('cat_name'),
		);

	   	$rules = array(
	        'name'=>'required',
	    );


	    $validator = Validator::make($input, $rules);

	    if ($validator->fails())
	    {

	        $messages = $validator->messages();

	        return Redirect::to('category/create')
	            ->withErrors($validator)
	            ->withInput();
	    } 
	    else
	    {
	        $category = new Category;
	        $category->name    = Input::get('cat_name');
	        $category->save();

	        return Redirect::to('categories');
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
		
		$rules = array(
	        'name'=>'required',
		 );

	    $input = array(
		 	'name' => Input::get('cat_name'),
	 	);


	    $validator = Validator::make($input, $rules);

	    if ($validator->fails())
	    {

	        $messages = $validator->messages();

	        return Redirect::to("category/$id/edit")
	            ->withErrors($validator)
	            ->withInput();
	    } 
	    else
	    {
	        $category = Category::find($id);
	        $category->name    = Input::get('cat_name');
	        $category->save();

	        return Redirect::to('categories');
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
		Category::find($id)->delete();
		return Redirect::to('categories');
	}


}
