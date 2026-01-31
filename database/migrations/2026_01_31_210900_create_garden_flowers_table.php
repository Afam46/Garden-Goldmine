<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('garden_flowers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('price');
            $table->float('stage')->default(1.0);
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->integer('time');
            $table->integer('use_time_water');
            $table->string('img');
            $table->string('descrip');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('category_id');
            $table->index(['user_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('garden_flowers');
    }
};
