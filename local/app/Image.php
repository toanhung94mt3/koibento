<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	protected $guarded = [];

    public function product()
    {

    	return $this->belongsTo('App\Product', 'product_id', 'id');

    }

}