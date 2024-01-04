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
        Schema::create('user_registers', function (Blueprint $table) {
          $table->string('id', 6)->primary();
          $table->tinyInteger('status_category_id');
          $table->tinyInteger('claim_type_id');
          $table->string('picture');
          $table->string('last_name');
          $table->string('first_name');
          $table->string('mid_name')->nullable();
          $table->string('ext_name')->nullable();
          $table->string('position');
          $table->string('department')->nullable(); // NOTE for prototype purposes, idk the data yet.
          $table->string('unit')->nullable(); // NOTE same as department
          $table->string('email')->nullable();
          $table->decimal('mobile', 10, 0)->unsigned();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_registers');
    }
};
