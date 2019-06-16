<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $guarded = [];

    public function categories()
    {

    	return $this->belongsTo('App\Category', 'category_id', 'id');

    }

    public function images()
    {

    	return $this->hasMany('App\Image', 'product_id', 'id');

    }

    public function orders()
    {

    	return $this->belongsToMany('App\Order', 'order_product', 'product_id', 'order_id')->withPivot('quantity');

    }

    public function users()
    {

        return $this->belongsToMany('App\User', 'product_user', 'product_id', 'user_id');

    }

}
