<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $categories = DB::table('dock_categories')->pluck('id')->toArray();
        $users = DB::table('users')->pluck('id')->toArray();
        
        for ($i = 1; $i <= 5; $i++) {
            DB::table('stations')->insert([
                'station' => $faker->sentence(2),
                'category_id' => $faker->randomElement($categories),
                'frequency' => $faker->randomElement(['AM', 'FM']),
                'rx_enabled' => $faker->boolean(),
                'user_id' => '13',
                'tx_enabled' => $faker->boolean(),
                'description' => $faker->paragraph(2),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
