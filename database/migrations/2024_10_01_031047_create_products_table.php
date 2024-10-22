<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // ID unik untuk setiap produk
            $table->string('name');  // Nama produk
            $table->decimal('price', 10, 2);  // Harga produk (dengan 2 desimal)
            $table->text('description')->nullable();  // Deskripsi produk (opsional)
            $table->string('image');  // Path gambar produk
            $table->timestamps();  // Tanggal pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
