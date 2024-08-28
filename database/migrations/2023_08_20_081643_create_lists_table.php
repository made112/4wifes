<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('date')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable(); // Change to unsignedBigInteger
            $table->enum('reminder_day', ['one_day', 'two_day', 'three_day'])->default('one_day')->nullable();
            $table->enum('reminder_hour', ['one_hour', 'three_hour', 'sex_hour'])->default('three_hour')->nullable();
            $table->unsignedBigInteger('house_id')->nullable();
            $table->enum('code', ['calendar', 'wishlist', 'needs','tasks'])->nullable();
            $table->boolean('save_status_weakly')->default(0)->nullable();
            $table->enum('status', ['pending', 'completed', 'expired'])->default('pending')->nullable();
            $table->timestamps();
            // Define foreign key constraints after creating the columns
            $table->foreign('parent_id')->references('id')->on('lists')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lists');
    }
};
