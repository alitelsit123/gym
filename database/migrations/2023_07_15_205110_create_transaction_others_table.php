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
        Schema::create('transaction_others', function (Blueprint $table) {
          $table->id();
          $table->string('name')->nullable();
          $table->string('phone')->nullable();
          $table->string('type')->nullable();
          $table->string('duration')->nullable();
          $table->string('payment_date')->nullable();
          $table->string('payment_eot')->nullable();
          $table->string('payment_approved')->nullable();
          $table->string('payment_changes')->nullable();
          $table->string('payment_type')->nullable();
          $table->string('status')->default('pending')->nullable();
          $table->bigInteger('gross_amount')->default(0)->nullable();
          $table->unsignedBigInteger('member_id')->nullable();
          $table->unsignedBigInteger('packet_id')->nullable();
          $table->unsignedBigInteger('trainer_id')->nullable();
          $table->unsignedBigInteger('membership_type_id')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_others');
    }
};
