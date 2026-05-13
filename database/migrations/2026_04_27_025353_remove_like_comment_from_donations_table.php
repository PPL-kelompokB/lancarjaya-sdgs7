<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['likes', 'comments']);
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);
        });
    }
};