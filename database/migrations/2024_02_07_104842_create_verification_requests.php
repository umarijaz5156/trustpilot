<?php

use App\Enums\VerificationStatus;
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
            
            Schema::create('verification_requests', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('status')->default(VerificationStatus::Pending->value);
                $table->timestamps();
    
                $table->foreign('user_id')->references('id')->on('common_database.users')->onDelete('cascade');
            });
    
            Schema::create('verification_responses', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('verification_request_id');
                $table->unsignedBigInteger('user_id');
                $table->text('response')->nullable();
                $table->timestamps();
    
                $table->foreign('verification_request_id')->references('id')->on('verification_requests')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('common_database.users')->onDelete('cascade');

            });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_responses');
        Schema::dropIfExists('verification_requests'); 
    
    }
};
