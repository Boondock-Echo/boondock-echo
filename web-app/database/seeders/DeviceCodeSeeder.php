<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DeviceCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfCodes = 10; // Adjust this as needed

        $codes = [];

        for ($i = 0; $i < $numberOfCodes; $i++) {
            $part1 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
            $part2 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
            $code = $part1 . '-' . $part2;
            
            $codes[] = [
                'code' => $code,
                'status' => 0,
                'dock_id' => null,
                'license_type' => 1,
                'storage_type' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('device_codes')->insert($codes);
    }
}