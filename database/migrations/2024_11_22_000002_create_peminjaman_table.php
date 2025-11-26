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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->unsignedBigInteger('id_peminjam');
            $table->unsignedBigInteger('id_kendaraan');
            $table->date('tanggal_pinjam');
            $table->time('waktu_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->time('waktu_kembali')->nullable();
            $table->enum('status_peminjaman', ['menunggu', 'disetujui', 'ditolak', 'berlangsung', 'selesai', 'batal'])->default('menunggu');
            $table->decimal('total_biaya', 12, 2)->default(0.00);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_peminjam', 'fk_peminjam')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_kendaraan', 'fk_kendaraan')
                ->references('id_kendaraan')
                ->on('kendaraan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
