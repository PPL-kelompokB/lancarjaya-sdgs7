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
        Schema::create('volunteer_reviews', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('volunteer_registration_id');

            $table->unsignedBigInteger('volunteer_request_id');

            $table->integer('rating');

            $table->text('review');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_reviews');
    }
};