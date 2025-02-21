<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('processors', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->nullable()->constrained();
      $table->foreignId('prototype_id')->constrained();
      
      $table->string('servicetag')->unique();
      $table->macAddress('mac')->unique();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('processors');
  }
};