<?php
class Book extends \Illuminate\Database\Eloquent\Model
{
	  protected $table = 'books';

	  public static function test(){
	  	return "you are connected";
	  }
}

