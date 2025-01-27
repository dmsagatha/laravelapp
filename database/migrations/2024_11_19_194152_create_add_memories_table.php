<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('add_memories', function (Blueprint $table) {
      $table->id();
      $table->string('brand');
      $table->string('technology');
      $table->string('velocity');
      $table->string('capacity');
      $table->unique(['brand', 'technology', 'velocity', 'capacity']);
      $table->string('slug')->unique();
      $table->timestamps();
    });

    Schema::create('add_memory_processor', function (Blueprint $table) {
      $table->id();
      $table->foreignId('add_memory_id')->constrained()->cascadeOnDelete();
      $table->foreignId('processor_id')->constrained()->cascadeOnDelete();
      $table->integer('quantity_addmem');
    });
  }
  
  public function down(): void
  {
    Schema::dropIfExists('add_memories');
    Schema::dropIfExists('add_memory_processor');
  }
};