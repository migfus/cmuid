<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('register_statuses', function (Blueprint $table) {
          $table->id();
          $table->string('user_register_id');
          $table->bigInteger('user_id')->nullable();
          $table->tinyInteger('category_id');
          $table->string('content')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_statuses');
    }
};
