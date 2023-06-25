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
        Schema::create('trainer_members', function (Blueprint $table) {
            $table->id();
            $table->string('duration')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('payment_eot')->nullable();
            $table->string('payment_approved')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('packet_id');
            $table->unsignedBigInteger('trainer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_members');
    }
};
