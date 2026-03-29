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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->string('organization_name');
            $table->string('organization_type');
            $table->text('address');
            $table->string('org_phone');

            $table->string('pic_name');
            $table->string('pic_email');
            $table->string('pic_phone');
            $table->year('founded_year')->nullable();
            $table->text('description')->nullable();
            $table->string('bank_name');
            $table->string('account_holder_name');
            $table->string('rekening_number');
            $table->text('verification_note')->nullable();
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
