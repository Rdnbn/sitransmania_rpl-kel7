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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_peminjaman');
            $table->enum('metode', ['qris', 'transfer']);
            $table->string('qr_code', 255)->nullable();
            $table->string('bukti_transfer', 255)->nullable();
            $table->decimal('jumlah_dibayar', 12, 2)->default(0.00);
            $table->enum('status_pembayaran', ['dp', 'dibayar'])->default('dp');
            $table->timestamp('tanggal_bayar')->useCurrent();

            $table->foreign('id_peminjaman', 'fk_peminjaman_pembayaran')
                ->references('id_peminjaman')
                ->on('peminjaman')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
