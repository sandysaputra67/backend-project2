<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
  protected $table='wishlist';
  protected $fillable=[
      'user_id',
      'produK_id',
  ];

  public  function produk(){
      return $this->belongsTo('App\Produk','produk_id');

  }
  public function user(){
      return $this->belongsTo('App\User','user_id');
  }
}
