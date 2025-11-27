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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id('id_kendaraan');
            $table->unsignedBigInteger('id_pemilik');
            $table->enum('jenis_kendaraan', ['sepeda', 'motor', 'motor_helm']);
            $table->string('nama_kendaraan', 100);
            $table->text('spesifikasi')->nullable();
            $table->string('foto_kendaraan', 255)->nullable();
            $table->text('syarat_ketentuan')->nullable();
            $table->string('nomor_rekening', 50)->nullable();
            $table->enum('status', ['tersedia', 'tidak_tersedia', 'tidak_aktif'])->default('tersedia');
            $table->date('tanggal_tersedia')->nullable();
            $table->time('waktu_tersedia')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_pemilik', 'fk_pemilik')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
