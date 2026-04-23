<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('blogs', function (Blueprint $table) {
    $table->id();

    // 🔥 siapa pembuat blog (user atau organization)
    $table->foreignId('user_id')
          ->constrained()
          ->onDelete('cascade');

    // 📝 isi blog
    $table->string('title');
    $table->text('content');

    # like komen
    $table->integer('likes')->default(0);
    $table->integer('comments')->default(0);

    // 🖼️ gambar blog (opsional)
    $table->string('image')->nullable();

    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
