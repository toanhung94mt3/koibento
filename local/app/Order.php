<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	protected $guarded = [];
	
    public function products()
    {

    	return $this->belongsToMany('App\Product', 'order_product', 'order_id', 'product_id')->withPivot('quantity');

    }

    public function user()
    {

    	return $this->belongsTo('App\User', 'user_id', 'id');

    }

    public function transaction()
    {
        return $this->hasOne('App\Transaction', 'order_id', 'id');
    }
}
