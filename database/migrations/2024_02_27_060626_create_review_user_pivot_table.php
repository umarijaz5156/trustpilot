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
        Schema::create('review_user_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_review_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
    
            $table->foreign('business_review_id')->references('id')->on('business_reviews')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('common_database.users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_user_pivot');
    }
};
