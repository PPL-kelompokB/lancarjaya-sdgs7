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
        Schema::table('donations', function (Blueprint $table) {
            $table->enum('validation_status', ['pending', 'valid', 'rejected'])
                ->default('pending')
                ->after('logistic_status');

            $table->text('validation_note')
                ->nullable()
                ->after('validation_status');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['validation_status', 'validation_note']);
        });
    }
};
