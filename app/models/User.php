<?php
class User extends \Illuminate\Database\Eloquent\Model
{
	  protected $table = 'users';
	  protected $primaryKey = 'user_id';

	  // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    // we only want these 3 attributes able to be filled
    // protected $fillable = array('name', 'type', 'danger_level');

    // DEFINE RELATIONSHIPS --------------------------------------------------
   
    public function proposals() {
        return $this->hasMany('Proposal'); // this matches the Eloquent model
    }

    // each bear climbs many trees
    public function likes() {
        return $this->hasMany('Like');
    }

    // each bear BELONGS to many picnic
    // define our pivot table also
    /*
    public function picnics() {
        return $this->belongsToMany('Picnic', 'bears_picnics', 'bear_id', 'picnic_id');
    }
	*/
}

