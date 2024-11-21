<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pokjas = [
            ['name' => 'Publikasi'],
            ['name' => 'Kemitraan'],
            ['name' => 'Pembelajaran'],
            ['name' => 'Tata Kelola'],
            ['name' => 'Tata Usaha'],
        ];

        DB::table('pokja')->insert($pokjas);
    }
}
