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
        Schema::create('business_claim_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('common_database.users')->cascadeOnDelete();
            $table->foreignId('business_account_id')->comment('requester id')->constrained('business_accounts')->cascadeOnDelete();
            $table->integer('is_claimed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_claim_requests');
    }
};
