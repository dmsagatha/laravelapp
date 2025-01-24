<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('memory_processor', function (Blueprint $table) {
      $table->id();
      $table->foreignId('processor_id')->constrained()->onDelete('cascade');
      $table->foreignId('memory_id')->constrained()->onDelete('cascade');
      $table->integer('quantity');
      $table->timestamps();
    });
  }
  
  public function down(): void
  {
    Schema::dropIfExists('memory_processor');
  }
};