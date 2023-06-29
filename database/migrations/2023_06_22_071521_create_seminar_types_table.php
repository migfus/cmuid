<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('seminar_types', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('user_id')->unsigned();
      $table->string('name');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('seminar_types');
  }
};
