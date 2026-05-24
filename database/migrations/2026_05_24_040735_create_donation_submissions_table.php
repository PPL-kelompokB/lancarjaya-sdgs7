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
        Schema::create('donation_submissions', function (Blueprint $table) {

            $table->id();

            // Donation campaign
            $table->foreignId('donation_id')
                ->constrained()
                ->onDelete('cascade');

            // Donor user
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Item info
            $table->string('item_name');

            $table->integer('quantity');

            $table->string('unit');

            // Pickup info
            $table->text('pickup_address');

            $table->string('phone_number');

            $table->date('pickup_date');

            // Extra notes
            $table->text('notes')->nullable();

            // Uploaded image
            $table->string('pickup_proof_image')->nullable();

            // Donation flow status
            $table->enum('status', [
                'pending',
                'approved',
                'pickup_on_the_way',
                'picked_up',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_submissions');
    }
};
