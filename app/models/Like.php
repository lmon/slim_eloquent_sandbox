<?php
class Like extends \Illuminate\Database\Eloquent\Model
{
	  protected $table = 'likes';
      protected $primaryKey = 'like_id';


	   public function user() {
        return $this->belongsTo('User');
    }

	
}

