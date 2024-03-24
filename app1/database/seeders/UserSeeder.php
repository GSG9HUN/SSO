<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Oláh',
                'last_name' => 'Sándor Lajos',
                'email' => 'olahsandorlajos99@gmail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('8524561973As'),
                'role_id' => '3'
            ],
            [
                'first_name' => 'Sántha',
                'last_name' => 'Máté Imre',
                'email' => 'santha.mate22@gmail.com',
                'email_verified_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('kecskepasztor22'),
                'role_id' => '3'
            ]
        ]);
    }
}
