<?php


class Reply extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reply';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function thread(){
		return $this->belongsTo('Thread');
	}

	public function user(){
		return $this->belongsTo('User');
	}

}
