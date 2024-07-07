<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisions')->insert([
            'name' => 'operasional',
            'description' => 'Operasional',
        ]);
        DB::table('divisions')->insert([
            'name' => 'marketing',
            'description' => 'Marketing',
        ]);
        DB::table('divisions')->insert([
            'name' => 'finance',
            'description' => 'Finance',
        ]);
        DB::table('divisions')->insert([
            'name' => 'direksi',
            'description' => 'Direksi',
        ]);
        DB::table('divisions')->insert([
            'name' => 'hr',
            'description' => 'HR',
        ]);
    }
}
