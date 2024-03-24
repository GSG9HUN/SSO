<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('color')->insert([
            ['name'=>'Fehér'],
            ['name'=>'Fekete'],
            ['name'=>'Barna'],
            ['name'=>'Szürke']
        ]);
    }
}
