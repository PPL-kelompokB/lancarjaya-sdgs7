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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('code')->nullable()->unique();

            // Discount
            $table->enum('discount_type', ['nominal', 'percentage', 'item'])->default('nominal');
            $table->decimal('discount_value', 12, 2)->default(0);

            // Points system
            $table->integer('points_cost')->default(0);

            // Quota
            $table->integer('quota')->default(0);
            $table->integer('used_count')->default(0);

            // Date
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Status
            $table->enum('status', ['active', 'inactive', 'expired'])->default('inactive');

            // Image voucher
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};