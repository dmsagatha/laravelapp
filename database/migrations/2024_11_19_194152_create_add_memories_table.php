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
  }
  
  public function down(): void
  {
    Schema::dropIfExists('add_memories');
  }
};
