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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('namaPemilik');
            $table->string('nik');
            $table->text('alamat');
            $table->text('fotoKtp');
            $table->string('namaUsaha');
            $table->text('alamatUsaha');
            $table->string('kategoriUsaha');
            $table->text('deskripsiUsaha');
            $table->double('omsetPerBulan');
            $table->double('jumlahPengajuan');
            $table->text('rencanaPengajuan');
            $table->integer("periodeBagiHasil");
            $table->double("persentaseBagiHasil");
            $table->text('companyProfile');
            $table->text('gambarProduk');
            $table->text('omsetTigaBulanTerakhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
