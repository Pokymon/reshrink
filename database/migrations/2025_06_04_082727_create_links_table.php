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
    Schema::create('links', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('user_id')
        ->constrained()
        ->onDelete('cascade');
      $table->string('url');
      $table->string('short_url');
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('links');
  }
};
