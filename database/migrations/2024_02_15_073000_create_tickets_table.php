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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_review_id')->constrained('business_reviews')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('common_database.users')->cascadeOnDelete();
            $table->foreignId('reviewer_user_id')->constrained('common_database.users')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->string('ticket_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
