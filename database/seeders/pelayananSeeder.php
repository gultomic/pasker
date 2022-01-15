<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Pelayanan;

class pelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelayanan::truncate();

        $faker = Faker::create('id_ID');

        Pelayanan::create([
            'title' => 'Konsultasi ' . ucwords($faker->word()),
            'refs' => [
                'antrian' => rand(20, 80),
                'deskripsi' => $faker->paragraph(),
                'aktif' => true,
                'kode' => 'A',
            ]
        ]);
        Pelayanan::create([
            'title' => 'Konsultasi ' . ucwords($faker->word()),
            'refs' => [
                'antrian' => rand(20, 80),
                'deskripsi' => $faker->paragraph(),
                'aktif' => true,
                'kode' => 'B',
            ]
        ]);
        Pelayanan::create([
            'title' => 'Pelayanan ' . ucwords($faker->word()),
            'refs' => [
                'antrian' => rand(20, 80),
                'deskripsi' => $faker->paragraph(),
                'aktif' => false,
                'kode' => 'C',
            ]
        ]);
        Pelayanan::create([
            'title' => 'Pelayanan ' . ucwords($faker->word()),
            'refs' => [
                'antrian' => rand(20, 80),
                'deskripsi' => $faker->paragraph(),
                'aktif' => true,
                'kode' => 'D',
            ]
        ]);
    }
}
