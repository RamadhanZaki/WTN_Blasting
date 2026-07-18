<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->nullable(); // Powder Coating / Vaporblasting
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // path di storage
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0); // urutan tampil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
