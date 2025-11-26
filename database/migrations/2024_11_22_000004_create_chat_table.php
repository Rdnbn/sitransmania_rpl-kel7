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
        Schema::create('chat', function (Blueprint $table) {
            $table->id('id_chat');
            $table->unsignedBigInteger('id_pengirim');
            $table->unsignedBigInteger('id_penerima');
            $table->unsignedBigInteger('id_peminjaman')->nullable();
            $table->text('isi_pesan');
            $table->timestamp('waktu_kirim')->useCurrent();
            $table->enum('status_baca', ['terkirim', 'dibaca'])->default('terkirim');

            $table->foreign('id_pengirim', 'fk_chat_pengirim')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_penerima', 'fk_chat_penerima')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_peminjaman', 'fk_chat_peminjaman')
                ->references('id_peminjaman')
                ->on('peminjaman')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat');
    }
};
