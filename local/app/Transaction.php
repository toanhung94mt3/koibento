<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }
}
