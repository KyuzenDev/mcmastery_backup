<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerReportsTable extends Migration
{
    public function up()
    {
        Schema::create('seller_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan ke tabel users
            $table->foreignId('seller_id')->constrained()->onDelete('cascade'); // Menghubungkan ke tabel sellers
            $table->text('reason'); // Alasan laporan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seller_reports');
    }
}
