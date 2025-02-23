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
        Schema::create('book_duration', function (Blueprint $table) {
            $table->id();
            $table->date('booking_date');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('hall_id')->nullable();
            $table->unsignedBigInteger('duration_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade');
            $table->foreign('duration_id')->references('id')->on('duration')->onDelete('cascade');
            $table->unique(['booking_date', 'duration_id', 'user_id','hall_id']);
            $table->unique(['booking_date', 'duration_id', 'user_id','service_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_duration');
    }
};