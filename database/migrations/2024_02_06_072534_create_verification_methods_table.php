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
        Schema::create('verification_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('field_text')->nullable();
            $table->text('default_response')->nullable();
            $table->boolean('attachments_allowed')->default(false);
            $table->string('response_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_methods');
    }
};
