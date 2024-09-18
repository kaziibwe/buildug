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
        Schema::create('auction_activities', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('price_change');
            $table->string('amount_before');
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_activities');
    }
};
