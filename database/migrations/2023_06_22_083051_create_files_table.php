<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('files', function (Blueprint $table) {
      $table->id();
      $table->integer('person_id')->unsinged();
      $table->string('filename');
      $table->string('url');
      $table->timestamps();
    });
  }

  public function down(): void {
      Schema::dropIfExists('files');
  }
};
