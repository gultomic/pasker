<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Klien;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;
use App\Models\Survei;

class klienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->klien();
        $this->jadwal();
        $this->antrianHariIni();
    }

    public function klien()
    {
        Klien::truncate();

        $faker = Faker::create('id_ID');

        for ($i=0; $i < 200 ; $i++) {
            Klien::create([
                'name'=>$faker->name(),
                'phone'=>$faker->numerify('08##########'),
            ]);
        }
    }

    public function jadwal()
    {
        PJ::truncate();
        Survei::truncate();

        $pel = Pelayanan::all();
        $klien = Klien::count();

        $w = Carbon::now()->startOfMonth()->subMonths(2);
        for ($m=1; $m <= 9 ; $m++) {
            for ($i=1; $i <= 5 ; $i++) {
                foreach ($pel as $p) {
                    $x;
                    $f =  $p->refs['antrian'] / 3;
                    $j = rand(5, floor($f) * 2);
                    for ($n=1; $n <= $j ; $n++) {
                        $c = PJ::create([
                            'pelayanan_id' => $p->id,
                            'klien_id' => rand(1, $klien),
                            'pelaksana_id' => rand(1, 3),
                            'tanggal' => $w->format('Y-m-d'),
                            'refs' => [
                                'antrian' => $p->refs['kode'] . sprintf('%03d', $n),
                                'status' => 'selesai',
                                'daftar' => 'online'
                            ],
                        ]);
                        $x = $n;

                        foreach ($p->kuesioner as $k) {
                            # code...
                            survei::create([
                                'jadwal_id' => $c->id,
                                'kuesioner_id' => $k->id,
                                'skor' => 3
                            ]);
                            // echo $k->pertanyaan_id . "\r";
                        }
                    }

                    $g = rand(5, floor($f));
                    for ($n=1; $n <= $g ; $n++) {
                        $x++;
                        $c = PJ::create([
                            'pelayanan_id' => $p->id,
                            'klien_id' => rand(50, $klien),
                            'pelaksana_id' => rand(1, 3),
                            'tanggal' => $w->format('Y-m-d'),
                            'refs' => [
                                'antrian' => $p->refs['kode'] . sprintf('%03d', $x),
                                'status' => 'selesai',
                                'daftar' => 'goshow'
                            ],
                        ]);

                        foreach ($p->kuesioner as $k) {
                            # code...
                            survei::create([
                                'jadwal_id' => $c->id,
                                'kuesioner_id' => $k->id,
                                'skor' => rand(1, 3)
                            ]);
                            // echo $k->pertanyaan_id . "\r";
                        }
                    }
                }
                echo $w." \r";
                $w->addDays(1);
            }
            $w->addDays(2);
        }
    }

    public function antrianHariIni()
    {
        $pel = Pelayanan::all();
        $klien = Klien::count();

        foreach ($pel as $p) {
            $blank = $p->refs['antrian'] - 10;
            for ($n=1; $n <= $blank ; $n++) {
                PJ::create([
                    'pelayanan_id' => $p->id,
                    'klien_id' => rand(1, $klien),
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'refs' => [
                        'antrian' => ""
                    ]
                ]);
            }

            // ADA TOKEN
            PJ::create([ // **SELESAI DILAYANI
                'pelayanan_id' => $p->id,
                'klien_id' => rand(1, $klien),
                'pelaksana_id' => 3,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'refs' => [
                    'antrian' => $p->refs['kode'] . "001",
                    'daftar' => "online",
                    'status' => "selesai",
                ]
            ]);

            PJ::create([ // **SEDANG DILAYANI
                'pelayanan_id' => $p->id,
                'klien_id' => rand(1, $klien),
                'pelaksana_id' => 3,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'refs' => [
                    'antrian' => $p->refs['kode'] . "002",
                    'daftar' => "online",
                    'status' => "berjalan",
                ]
            ]);

            for ($i=3; $i <= 5 ; $i++) {
                PJ::create([
                    'pelayanan_id' => $p->id,
                    'klien_id' => rand(30, $klien),
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'refs' => [
                        'antrian' => $p->refs['kode'] . "00" . $i,
                        'daftar' => "online",
                        'status' => "menunggu",
                    ]
                ]);
            }
            // DAFTAR ONSITE
            PJ::create([
                'pelayanan_id' => $p->id,
                'klien_id' => rand(100, $klien),
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'refs' => [
                    'antrian' => $p->refs['kode'] . "006",
                    'daftar' => "goshow",
                    'status' => "menunggu",
                ]
            ]);

        }
    }
}
