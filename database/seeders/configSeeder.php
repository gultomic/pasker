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

        // LOKET PELAYANAN
        Config::create([
            'title' => 'loket_pelayanan',
            'refs' => [
                'Loket 1', 'Loket 2', 'Loket 3', 'Loket 4',
                // ['id'=>1, 'name'=>'Loket 1', 'queue'=>''],
                // ['id'=>2, 'name'=>'Loket 2', 'queue'=>''],
                // ['id'=>3, 'name'=>'Loket 3', 'queue'=>''],
                // ['id'=>4, 'name'=>'Loket 4', 'queue'=>'']
            ],
        ]);
    }
}
