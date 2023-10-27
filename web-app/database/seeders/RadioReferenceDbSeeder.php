<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RadioReferenceDbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('radio_reference_db')->insert([
            [
                'state' => 'California',
                'county' => 'Los Angeles',
                'city' => 'Los Angeles',
                'zip' => '90001',
                'frequency' => '123.456',
                'license' => 'ABC123',
                'type' => 'Public Safety',
                'tone' => 'CTCSS',
                'alpha_tag' => 'LA Police',
                'description' => 'Police Dispatch',
                'mode' => 'Analog',
                'tag' => 'PD'
            ],[
                'state' => 'Illinois',
                'county' => 'DuPage',
                'city' => 'Lombard',
                'zip' => '60148',
                'frequency' => '154.875',
                'license' => 'XYZ456',
                'type' => 'Public Safety',
                'tone' => 'PL',
                'alpha_tag' => 'Lombard Police',
                'description' => 'Police Dispatch',
                'mode' => 'Analog',
                'tag' => 'PD'
            ]
            // Add more dummy data as needed
        ]);
    }
}