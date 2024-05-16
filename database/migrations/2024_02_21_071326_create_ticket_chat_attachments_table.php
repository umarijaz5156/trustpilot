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
        Schema::create('ticket_chat_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_chat_id');
            $table->string('file_path');
            $table->string('file_type');
            $table->timestamps();

            $table->foreign('ticket_chat_id')->references('id')->on('ticket_chats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_chat_attachments');
    }
};
