<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar');
            $table->enum('jenis_kamar', [
                'Standard Room',
                'Deluxe Room',
                'Suite Room'
            ]);
            $table->decimal('harga', 10, 2);
            $table->enum('status', [
                'Available',
                'Booked',
                'Not Available'
            ])->default('Available');
            $table->text('fasilitas');
            $table->string('gambar_kamar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
