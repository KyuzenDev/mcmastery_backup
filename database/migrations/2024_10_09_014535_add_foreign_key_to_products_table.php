<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Pastikan seller_id sudah ada di tabel products
            $table->unsignedBigInteger('seller_id')->change();  // Jika belum bertipe unsignedBigInteger, bisa ubah dengan change().

            // Tambahkan foreign key constraint
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropForeign(['seller_id']);
        });
    }

};
