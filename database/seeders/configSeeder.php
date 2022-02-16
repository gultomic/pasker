<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;

class configSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::truncate();

        $loket = ['Loket 1', 'Loket 2', 'Loket 3', 'Loket 4'];
        // LOKET PELAYANAN
        Config::create([
            'title' => 'loket_pelayanan',
            'refs' => $loket,
        ]);

        // AKTIF LOKET
        Config::create([
            'title' => 'loket_aktif',
            'refs' => [
                [
                    'tanggal' => '2022-01-25',
                    'nama' => 'Loket 1',
                    'pelayanan' => 'Konsultasi A',
                    'pelaksana' => '...'
                ],
                [
                    'tanggal' => '2022-01-24',
                    'nama' => 'Loket 2',
                    'pelayanan' => 'Konsultasi B',
                    'pelaksana' => '...'
                ],
            ]
        ]);

        // LOKET JAM PELAJAYANAN
        //MINGGU is 0 OF DAY OF WEEK NUMBER
        Config::create([
            'title' => 'loket_jam',
            'refs' => [
                [
                    'hari' => 'Minggu',
                    'jam_buka' => '09:00',
                    'jam_tutup' => '15:00',
                    'kuota_per_jam' => '5',
                    'libur'=>1
                ],
                [
                    'hari' => 'Senin',
                    'jam_buka' => '09:00',
                    'jam_tutup' => '15:00',
                    'kuota_per_jam' => '5',
                    'libur'=>0
                ],
                [
                    'hari' => 'Selasa',
                    'jam_buka' => '09:00',
                    'jam_tutup' => '15:00',
                    'kuota_per_jam' => '5',
                    'libur'=>0
                ],
                [
                    'hari' => 'Rabu',
                    'jam_buka' => '09:00',
                    'jam_tutup' => '15:00',
                    'kuota_per_jam' => '5',
                    'libur'=>0
                ],
                [
                    'hari' => 'Kamis',
                    'jam_buka' => '09:00',
                    'jam_tutup' => '15:00',
                    'kuota_per_jam' => '5',
                    'libur'=>0
                ],
                [
                    'hari' => 'Jumat',
                    'jam_buka' => '09:00',
                    'jam_tutup' => '11:00',
                    'kuota_per_jam' => '5',
                    'libur'=>0
                ],
                [
                    'hari' => 'Sabtu',
                    'jam_buka' => '09:00',
                    'jam_tutup' => '15:00',
                    'kuota_per_jam' => '5',
                    'libur'=>1
                ],

            ]
        ]);

        // MARQUEE
        Config::create([
            'title' => 'list_marquee',
            'refs' => [
                "Selamat Datang di PASKER.ID Silahkan Melakukan Konsultasi.",
                "Waspada Bahaya Corona, Jaga Diri Anda dan Keluarga dengan Selalu Menerapkan Protokol 3T."
            ]
        ]);
        // YOUTUBE ID'S
        Config::create([
            'title' => 'list_video',
            'refs' => [ "tmerNTqPosM","0Bmhjf0rKe8","6kUItwCsds7q7o","LheNDiNekzA","0Bmhjf0rKe8","6kUItwCsds7q7o","LheNDiNekzA" ]
        ]);

        // JAWABAN SURVEY
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
    }
}
