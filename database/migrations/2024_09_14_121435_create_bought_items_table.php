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
        Schema::create('bought_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lot_number')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('meter');
            $table->string('serial_number');
            $table->string('features');
            $table->string('note');
            $table->string('year');
            $table->string('manufacturer');
            $table->string('asset_type')->nullable();;
            $table->string('appearance');
            $table->string('general');
            $table->string('function');
            $table->string('dimension');
            $table->string('actual_price');
            $table->string('bid_price');
            $table->string('status');

            $table->foreignId('equipmentcategory_id')
            ->nullable()
            ->constrained('equipment_categories')
            ->onDelete('set null');
            $table->foreignId('subcategory_id')
            ->nullable()
            ->constrained('sub_categories')
            ->onDelete('set null');

            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bought_items');
    }
};
