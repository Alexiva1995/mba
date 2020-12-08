<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'memberships';

    protected $fillable = ['name', 'image', 'price', 'price_annual', 'descuento', 'discount_annual', 'ganancia', 'type'];

    public function users(){
        return $this->hasMany('App\Models\User');
    }

    public function courses(){
        return $this->hasMany('App\Models\Course');
    }

    public function shopping_carts(){
        return $this->hasMany('App\Models\ShoppingCart');
    }

    public function details(){
        return $this->hasMany('App\Models\ShoppingCart');
    }
}
