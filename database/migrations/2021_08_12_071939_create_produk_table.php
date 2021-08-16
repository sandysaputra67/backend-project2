<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_produk');
              $table->string('nama_produk');
              $table->string('slug_produk');
              $table->string('deskripsi_produk');
              $table->string('status');
              $table->double('qty', 12, 2)->default(0);
              $table->string('satuan');
              $table->double('harga', 12, 2)->default(0);
              $table->integer('foto')->nullable();
              $table->integer('user_id')->unsigned();
              $table->foreign('kategori_id')->references('id')->on('kategori');
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
