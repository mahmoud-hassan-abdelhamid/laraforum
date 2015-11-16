<?php

class Forum extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'forum';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function category(){
		return $this->belongsTo('Category');
	}
		public function thread(){
		return $this->hasMany('Thread');
	}

}
