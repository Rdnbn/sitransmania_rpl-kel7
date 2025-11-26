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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('id_notif');
            $table->unsignedBigInteger('id_user');
            $table->string('judul', 100);
            $table->text('isi');
            $table->enum('tipe', ['sistem', 'chat', 'pembayaran', 'peminjaman']);
            $table->enum('status', ['baru', 'dibaca'])->default('baru');
            $table->timestamp('waktu')->useCurrent();

            $table->foreign('id_user', 'fk_notif_user')
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
        Schema::dropIfExists('notifikasi');
    }
};
