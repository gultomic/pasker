<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;
use App\Models\Pertanyaan;
use App\Models\Kuesioner;
use Faker\Factory as Faker;

class pertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        Config::where('title', 'metode_jawaban')->delete();
        Config::create([
            'title' => 'metode_jawaban',
            'refs' => [
                [
                    'judul' => '3 poin',
                    'opsi' => [
                        [
                            'skor' => 1,
                            'nama' => 'tidak puas',
                            'button' => '<i class="far fa-frown"></i>'
                        ],
                        [
                            'skor' => 2,
                            'nama' => 'puas',
                            'button' => '<i class="far fa-smile"></i>'
                        ],
                        [
                            'skor' => 3,
                            'nama' => 'sangat puas',
                            'button' => '<i class="far fa-laugh"></i>'
                        ]
                    ],
                ]
            ]
        ]);

        Pertanyaan::truncate();
        for ($i=0; $i < 20; $i++) {
            Pertanyaan::create([
                'pertanyaan' => $faker->words(8, true),
                'refs' => [
                    'metode_jawaban' => '3 poin',
                    'opsi_jawaban' => [
                        [
                            'skor' => 1,
                            'nama' => 'tidak puas',
                            'button' => '<i class="far fa-frown"></i>'
                        ],
                        [
                            'skor' => 2,
                            'nama' => 'puas',
                            'button' => '<i class="far fa-smile"></i>'
                        ],
                        [
                            'skor' => 3,
                            'nama' => 'sangat puas',
                            'button' => '<i class="far fa-laugh"></i>'
                        ],
                    ]
                ]
            ]);
        }

        Kuesioner::truncate();
        $pelayanan = \App\Models\Pelayanan::all();
        $pertanyaan = Pertanyaan::count();

        foreach ($pelayanan as $key => $value) {
            for ($i=1; $i <= 4; $i++) {
                # code...
                Kuesioner::create([
                    'pelayanan_id' => $value->id,
                    'pertanyaan_id' => rand(1, $pertanyaan),
                    'nomor' => $i,
                ]);
            }
        }
    }
}
