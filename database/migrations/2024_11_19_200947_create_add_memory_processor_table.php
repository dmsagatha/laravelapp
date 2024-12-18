<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('add_memory_processor', function (Blueprint $table) {
      $table->id();
      $table->foreignId('add_memory_id')->constrained()->onDelete('cascade');
      $table->foreignId('processor_id')->constrained()->onDelete('cascade');
      $table->integer('quantity_addmem');
    });
  }
  
  public function down(): void
  {
    Schema::dropIfExists('add_memory_processor');
  }
};