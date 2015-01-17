<?php
class Proposal extends \Illuminate\Database\Eloquent\Model
{
	  protected $table = 'proposals';
      protected $primaryKey = 'proposal_id';


    // each bear BELONGS to many picnic
    // define our pivot table also
    
   public function user() {
        return $this->belongsTo('User');
    }
	
}

