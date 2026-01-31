<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flowers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('price');
            $table->string('img');
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->integer('use_time_water');
            $table->string('descrip');
            $table->timestamps();
            
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flowers');
    }
};