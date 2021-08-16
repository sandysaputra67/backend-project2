<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
  protected $table = 'produk';
  protected $fillable= [
   'kode_produk',
   'kategori_id',
   'nama_produk',
   'slug_produk',
   'deskripsi_produk',
   'status',
   'qty',
   'satuan',
   'harga',
   'foto',
  ];
  public function user(){
    return $this->belongsTo('App\User','user_id');
  }
  public function kategori(){
    return $this->belongsTo('App\Kategori','kategori_id');
  }
  public function images(){
    return $this->hasMany('App\ProdukImage','produk_id');
  }

  public function promo(){
    return $this->hasOne('App\ProdukPromo','produk_id');
  }
}
