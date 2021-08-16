<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'cart_id',
    
    ];

    public function cart() {
        return $this->belongsTo('App\Cart', 'cart_id');
    }
}
