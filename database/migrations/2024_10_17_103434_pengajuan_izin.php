<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_izins', function (Blueprint $table) {
            $table->id(); // Kolom id untuk primary key
            $table->unsignedBiginteger("user_id");
            $table->string('nama'); // Nama pengaju izin
            $table->string('tipe_izin')->nullable()->default(''); // atau default value lain jika diinginkan
            $table->string('jabatan'); // Jabatan pengaju izin
            $table->date('tanggal'); // Tanggal pengajuan izin
            $table->string('alasan_izin'); // Alasan pengajuan izin
            $table->string('lampiran')->nullable();  // Sudah benar, pastikan tipe kolom adalah string
            $table->string('status')->default('Pending'); // Status approval (Pending, Disetujui, Ditolak)
            $table->unsignedBigInteger('approved_by')->nullable(); // ID admin yang menyetujui izin
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_izins');
    }
};