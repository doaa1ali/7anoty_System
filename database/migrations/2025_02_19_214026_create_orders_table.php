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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('final_price', 10, 2)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cemetery_id')->nullable();
            //$table->unsignedBigInteger('book_duration_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cemetery_id')->references('id')->on('cemeteries')->onDelete('cascade');
            //$table->foreign('book_duration_id')->references('id')->on('book_duration')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
