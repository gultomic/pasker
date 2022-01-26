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
            // [
            //     'Loket 1', 'Loket 2', 'Loket 3', 'Loket 4',
            //     // ['id'=>1, 'name'=>'Loket 1', 'queue'=>''],
            //     // ['id'=>2, 'name'=>'Loket 2', 'queue'=>''],
            //     // ['id'=>3, 'name'=>'Loket 3', 'queue'=>''],
            //     // ['id'=>4, 'name'=>'Loket 4', 'queue'=>'']
            // ],
        ]);

        // AKTIF LOKET
        Config::create([
            'title' => 'loket_aktif',
            'refs' => [
                [
                    'tanggal' => '2022-01-25',
                    'nama' => 'Loket 1',
                    'pelayanan' => 'Konsultasi A',
                    'pelaksana' => 'ada namanya'
                ],
                [
                    'tanggal' => '2022-01-24',
                    'nama' => 'Loket 2',
                    'pelayanan' => 'Konsultasi B',
                    'pelaksana' => 'ada namanya'
                ],
            ]
        ]);
    }
}
