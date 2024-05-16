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
        // Schema::connection('common_database')->table('users', function (Blueprint $table) {
        //     $table->boolean('is_hot_bleep')->default(false);

        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::connection('common_database')->table('users', function (Blueprint $table) {
        //     $table->dropColumn('is_hot_bleep');

        // });
    }
};
