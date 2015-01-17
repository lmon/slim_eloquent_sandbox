<?php
 
namespace Models;
 
use Illuminate\Database\Eloquent\Model as Model;
 
class BaseModel extends Model {
 
	public $timestamps = false;
	 
	public $update_record = false;
	 
	protected $data;
	 
	public function userInput($data) {
	 
		$this->data = $data;
	 
	}
	 
	public function save(array $options = array()) {
		 
		$this->date_updated = date('Y-m-d H:i:s');
		 
		$this->updated_from_ip = $_SERVER['REMOTE_ADDR'];
		 
		if ($this->update_record == false) {
		 
		$this->date_created = $this->date_updated;
		 
		$this->created_from_ip = $this->updated_from_ip;
	 
	}
	 
	parent::save();
	 
	}
 
}
