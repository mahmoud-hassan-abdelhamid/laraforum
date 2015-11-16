<?php

class Thread extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'thread';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function reply(){
		return $this->hasMany('Reply');
	}

	public function user(){
		return $this->belongsTo('User');
	}

	public function forum(){
		return $this->belongsTo('Forum');
	}

}
