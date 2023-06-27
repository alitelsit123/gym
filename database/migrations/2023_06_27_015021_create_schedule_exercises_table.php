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
        Schema::create('schedule_exercises', function (Blueprint $table) {
            $table->id();
            $table->string('daym');
            $table->text('description');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('trainer_member_id');
            $table->unsignedBigInteger('packet_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_exercises');
    }
};
