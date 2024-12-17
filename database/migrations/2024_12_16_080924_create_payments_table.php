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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan ke user
        $table->string('game_title');
        $table->string('item');
        $table->string('payment_method');
        $table->string('account_number');
        $table->decimal('total', 10, 2);
        $table->string('payment_proof'); // Lokasi file bukti pembayaran
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status pembayaran
        $table->string('redeem_code')->nullable(); // Redeem code jika pembayaran disetujui
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
