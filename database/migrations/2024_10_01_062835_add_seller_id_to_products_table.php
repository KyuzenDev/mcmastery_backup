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
            // $table->unsignedBigInteger('seller_id')->after('id'); // Tambahkan seller_id setelah kolom id
            // $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade'); // Relasi dengan tabel users
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['seller_id']); // Hapus foreign key
            $table->dropColumn('seller_id'); // Hapus kolom seller_id
        });
    }

};
