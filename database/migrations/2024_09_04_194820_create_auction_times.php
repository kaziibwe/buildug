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
        Schema::create('auction_times', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('open_time');
            $table->string('close_time');
            $table->string('item_interval');
            $table->foreignId('auction_type_id')->constrained()->references('id')->on('auction_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_times');
    }
};
