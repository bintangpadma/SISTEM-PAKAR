<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KerusakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kerusakans')->insert([
            [
                'kode_kerusakan' => 'K001',
                'kerusakan' => 'Motherboard',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_kerusakan' => 'K002',
                'kerusakan' => 'VGA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_kerusakan' => 'K003',
                'kerusakan' => 'RAM',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_kerusakan' => 'K004',
                'kerusakan' => 'Power Supply',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_kerusakan' => 'K005',
                'kerusakan' => 'Harddisk',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_kerusakan' => 'K006',
                'kerusakan' => 'Processor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
