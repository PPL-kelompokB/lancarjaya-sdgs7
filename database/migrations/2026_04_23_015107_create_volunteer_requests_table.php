<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('volunteer_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained('organizations')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('task_description');
            $table->text('required_skills')->nullable();
            $table->integer('volunteer_quota');
            $table->date('deadline');
            $table->date('event_date');
            $table->enum('event_type', ['online', 'offline', 'hybrid']);
            $table->string('location');
            $table->decimal('location_radius', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
<<<<<<< HEAD
            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);
=======
        
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteer_requests');
    }
};