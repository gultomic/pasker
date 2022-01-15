<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Klien;
use App\Models\Pelayanan;
use App\Models\PelayananJadwal as PJ;

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
        $this->antrian();
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

        $pel = Pelayanan::all();
        $klien = Klien::count();

        $w = Carbon::now()->subDays(7)->startOfWeek();
        for ($i=1; $i <= 5 ; $i++) {
            foreach ($pel as $p) {
                // $a = $p->refs['antrian'];
                for ($n=1; $n <= $p->refs['antrian'] ; $n++) {
                    PJ::create([
                        'pelayanan_id' => $p->id,
                        'klien_id' => rand(1, $klien),
                        'pelaksana_id' => rand(1, 3),
                        'tanggal' => $w->format('Y-m-d'),
                        'refs' => [
                            'antrian' => $p->refs['kode'] . sprintf('%03d', $n),
                        ],
                    ]);
                }
            }
            $w->addDays(1);
        }
    }

    public function antrian()
    {
        $pel = Pelayanan::all();
        $klien = Klien::count();

        foreach ($pel as $p) {
            // echo $p->refs['antrian'] . "\n";
            for ($n=1; $n <= $p->refs['antrian'] ; $n++) {
                // echo $n . " ";
                PJ::create([
                    'pelayanan_id' => $p->id,
                    'klien_id' => rand(1, $klien),
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                ]);
            }
            // echo "\n";
        }
    }
}
