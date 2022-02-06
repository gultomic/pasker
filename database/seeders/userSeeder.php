<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('roles')->truncate();
        DB::table('profiles')->truncate();

        $faker = Faker::create('id_ID');
        $stafs = [
            ['nama'=>'staf','photo'=>'young-man.png'],
            ['nama'=>'user','photo'=>'beauty.png'],
            ['nama'=>'demo','photo'=>'beard.png']
        ];

        foreach ($stafs as $key => $value) {
            $x = User::create([
                'username'=>$value['nama'],
                'email'=>$value['nama']."@example.com",
                'phone'=>$faker->numerify('08##########'),
                'password'=> Hash::make('login123'),
                'email_verified_at'=>\Carbon\Carbon::now(),
            ]);

            $x->role()->create([
                'level'=>'staf',
            ]);
            $x->profile()->create([
                'refs'=>[
                    'fullname'=>$faker->name(),
                    'photo'=>"/assets/uploads/".$value['photo'],
                ]
            ]);
        }

        // ADMIN CREDENTIAL
        $admin = User::create([
            'username'=>'admin',
            'email'=>'admin@example.com',
            'phone'=>'084444444',
            'password'=> Hash::make('login123'),
            'email_verified_at'=>\Carbon\Carbon::now(),
            'phone_verified_at'=>\Carbon\Carbon::now(),
        ]);
        $admin->role()->create([
            'level'=>'master',
        ]);
        $admin->profile()->create([
            'refs'=>[
                'fullname'=>'Administrator',
                'photo'=>'/assets/uploads/hacker.png',
            ]
        ]);

        // CREATOR CREDENTIAL
        $master = User::create([
            'username'=>'origin',
            'email'=>'origin@example.com',
            'phone'=>'08000000',
            'password'=> Hash::make('login123!@#'),
            'email_verified_at'=>\Carbon\Carbon::now(),
            'phone_verified_at'=>\Carbon\Carbon::now(),
        ]);
        $master->role()->create([
            'level'=>'master',
        ]);
        $master->profile()->create([
            'refs'=>[
                'fullname'=>'Origin',
                'photo'=>'/assets/uploads/hacker.png',
            ]
        ]);
    }
}
