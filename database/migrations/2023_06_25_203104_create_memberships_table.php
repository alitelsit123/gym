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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending')->nullable();
            $table->integer('duration')->default(0)->nullable();
            $table->string('payment_approved')->nullable();
            $table->string('payment_eot')->nullable();
            $table->string('payment_date')->nullable();
            $table->unsignedBigInteger('membership_type_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
