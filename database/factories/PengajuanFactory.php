<?php

namespace Database\Factories;

use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengajuanFactory extends Factory
{
    protected $model = Pengajuan::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 12),
            'namaPemilik' => $this->faker->name,
            'nik' => $this->faker->numerify('################'),
            'alamat' => $this->faker->address,
            'fotoKtp' => $this->faker->imageUrl(),
            'namaUsaha' => $this->faker->company,
            'alamatUsaha' => $this->faker->address,
            'kategoriUsaha' => $this->faker->word,
            'deskripsiUsaha' => $this->faker->paragraph,
            'omsetPerBulan' => $this->faker->numberBetween(1000000, 100000000),
            'jumlahPengajuan' => $this->faker->numberBetween(1000000, 100000000),
            'rencanaPengajuan' => $this->faker->sentence,
            'periodeBagiHasil' => $this->faker->numberBetween(1, 12),
            'persentaseBagiHasil' => $this->faker->numberBetween(1, 100),
            'companyProfile' => $this->faker->paragraph,
            'gambarProduk' => $this->faker->imageUrl(),
            'omsetTigaBulanTerakhir' => $this->faker->numberBetween(3000000, 300000000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}