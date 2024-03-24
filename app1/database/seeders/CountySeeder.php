<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('county')->insert([
            ['name' => 'Bács-Kiskun'], //1
            ['name' => 'Baranya'], //2
            ['name' => 'Békés'], //3
            ['name' => 'Borsod-Abaúj-Zemplén'], //4
            ['name' => 'Csongrád-Csanád'], //5
            ['name' => 'Fejér'], //6
            ['name' => 'Győr-Moson-Sopron'],//7
            ['name' => 'Hajdú-Bihar'], //8
            ['name' => 'Heves'], //9
            ['name' => 'Jász-Nagykun-Szolnok'],//10
            ['name' => 'Komárom-Esztergom'], //11
            ['name' => 'Nógrád'], //12
            ['name' => 'Pest'], //13
            ['name' => 'Somogy'], //14
            ['name' => 'Szabolcs-Szatmár-Bereg'],//15
            ['name' => 'Tolna'], //16
            ['name' => 'Vas'], //17
            ['name' => 'Veszprém'], //18
            ['name' => 'Zala'], //19
            ['name' => 'Budapest'] //20
        ]);
    }
}
