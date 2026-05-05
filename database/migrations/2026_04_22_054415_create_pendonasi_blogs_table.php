<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendonasi_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('category');
            $table->string('tags')->nullable();
            $table->string('image')->nullable();

            // ✅ TAMBAHAN STATUS
            $table->enum('status', ['draft', 'publish'])->default('draft');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // ✅ FIX NAMA TABEL
        Schema::dropIfExists('pendonasi_blogs');
    }
};