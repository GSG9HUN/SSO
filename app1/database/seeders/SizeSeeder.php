<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('size')->insert([
            ['name'=>'Kicsi'],
            ['name'=>'Közepes'],
            ['name'=>'Nagy']
        ]);
    }
}
