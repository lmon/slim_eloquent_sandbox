<?php
 
namespace Models;
 
class Customers extends BaseModel {
 
	protected $primaryKey = 'customer_id';
	 
	public function save(array $options = array()) {
	 
		$this->name = $this->data['name'];
		 
		$this->email = $this->data['email'];
		 
		$this->contact_person  = $this->data['contact_person'];
		 
		$this->postal_address = $this->data['postal_address'];
		 
		$this->physical_address = $this->data['physical_address'];
		 
		$this->contact_number = $this->data['contact_number'];
		 
		$this->employee_id = $this->data['employee_id'];
		 
		parent::save();
	 
	}
 
}
