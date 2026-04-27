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
<<<<<<< HEAD
            $table->dropColumn(['likes', 'comments']);
=======
            //
>>>>>>> 7bb0b4b (Rena menambahkan fitur like dan komen pada blog, dan volunteer)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
<<<<<<< HEAD
            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);
=======
            //
>>>>>>> 7bb0b4b (Rena menambahkan fitur like dan komen pada blog, dan volunteer)
        });
    }
};
