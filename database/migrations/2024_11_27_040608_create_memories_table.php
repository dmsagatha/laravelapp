<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('memories', function (Blueprint $table) {
      $table->id();
      $table->string('serial')->unique();
      $table->string('capacity');
      $table->string('technology');
      $table->string('velocity');
      $table->timestamps();
    });
  }
  
  public function down(): void
  {
    Schema::dropIfExists('memories');
  }
};