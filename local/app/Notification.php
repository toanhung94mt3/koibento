<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $guarded = [];

    public function user()
    {

    	return $this->belongsTo('App\User', 'user_id', 'id');

    }
 
}
