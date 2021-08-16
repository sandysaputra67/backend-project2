<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
  protected $table='kategori';
  protected $fillable=[
    'kode_kategori',
    'nama_kategori',
    'slug_kategori',
    'deskripsi_kategori',
    'status',
    'foto',
    'user_id'
  
    
    
    
  ];

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

}
