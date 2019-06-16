<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    public function orders()
    {

        return $this->hasMany('App\Order', 'user_id', 'id');

    }

    public function notifications()
    {

        return $this->hasMany('App\Notification', 'user_id', 'id');

    }

    public function products()
    {

        return $this->belongsToMany('App\Product', 'product_user', 'user_id', 'product_id');

    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
