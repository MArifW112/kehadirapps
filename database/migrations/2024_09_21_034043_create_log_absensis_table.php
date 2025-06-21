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
        Schema::create('log_absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger("user_id");
            $table->date("tanggal")->nullable();
            $table->string("nama")->nullable();
            $table->dateTime("absensi_masuk")->nullable();
            $table->dateTime("absensi_keluar")->nullable();
            $table->dateTime("istirahat_mulai")->nullable();
            $table->dateTime("istirahat_selesai")->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('log_absensis');
    }
};
