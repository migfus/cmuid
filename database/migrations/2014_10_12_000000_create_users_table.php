<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->integer('person_id')->unique();
      $table->string('email')->unique()->nullable();
      $table->string('password')->nullable();
      $table->string('avatar')->nullable();

      $table->timestamp('email_verified_at')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });
  }

  public function down(): void {
      Schema::dropIfExists('users');
  }
};
