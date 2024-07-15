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
        Schema::create('pemodal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('namaLengkap');
            $table->string('jenisKelamin');
            $table->text('alamat');
            $table->text('fotoKtp');
            $table->string('tempatLahir');
            $table->date('tanggalLahir');
            $table->string('pekerjaan');
            $table->string('namaBank');
            $table->string('noRekening');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemodal');
    }
};
