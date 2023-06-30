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
        Schema::table('orders', function (Blueprint $table) {
          $table->string('payment_type')->nullable();
          $table->bigInteger('payment_total')->default(0)->nullable();
          $table->bigInteger('payment_changes')->default(0)->nullable();
        });
        Schema::table('memberships', function (Blueprint $table) {
          $table->string('payment_type')->nullable();
          $table->bigInteger('payment_total')->default(0)->nullable();
          $table->bigInteger('payment_changes')->default(0)->nullable();
        });
        Schema::table('trainer_members', function (Blueprint $table) {
          $table->string('payment_type')->nullable();
          $table->bigInteger('payment_total')->default(0)->nullable();
          $table->bigInteger('payment_changes')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
          $table->dropColumn(['payment_type','payment_total','payment_changes']);
        });
        Schema::table('memberships', function (Blueprint $table) {
          $table->dropColumn(['payment_type','payment_total','payment_changes']);
        });
        Schema::table('trainer_members', function (Blueprint $table) {
          $table->dropColumn(['payment_type','payment_total','payment_changes']);
        });
    }
};
