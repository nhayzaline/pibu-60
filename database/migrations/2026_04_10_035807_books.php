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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 50);
            $table->string('ISBN', 13);
            $table->string('penulis', 50);
            $table->string('penerbit', 50);
            $table->integer('tahun_terbit');
            $table->integer('stok');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('cover_image')->nullable(); // Tambahan untuk display landing page
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
