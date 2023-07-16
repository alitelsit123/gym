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
        Schema::create('transaction_other_details', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('quantity');
          $table->unsignedBigInteger('sub_amount');
          $table->unsignedBigInteger('product_id');
          $table->unsignedBigInteger('order_id');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_other_details');
    }
};
