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
        Schema::table('trainer_members', function (Blueprint $table) {
          $table->string('start_date')->nullable();
        });
        Schema::table('memberships', function (Blueprint $table) {
          $table->string('start_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainer_members', function (Blueprint $table) {
          $table->dropColumn(['start_date']);
        });
        Schema::table('memberships', function (Blueprint $table) {
          $table->dropColumn(['start_date']);
        });
    }
};
