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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            // Relasi ke organisasi
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');

            // Informasi utama donasi
            $table->string('title');
            $table->text('description')->nullable();

            // Detail barang
            $table->string('item_name');
            $table->string('category')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit')->nullable(); // pcs, box, kg, dll

            // Lokasi / alamat
            $table->text('address');
            $table->string('city')->nullable();
            $table->string('province')->nullable();

            // Kontak penanggung jawab
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();

            // Timeline
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Status campaign donasi
            $table->enum('status', [
                'open',
                'in_progress',
                'completed',
                'cancelled'
            ])->default('open');

            // Status logistik barang
            $table->enum('logistic_status', [
                'waiting_pickup',
                'picked_up',
                'in_transit',
                'arrived',
                'processed',
                'distributed'
            ])->default('waiting_pickup');

            $table->timestamps();

            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};