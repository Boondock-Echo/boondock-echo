<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DockCategory;

class DockCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DockCategory::create([
            'name' => 'Radio club Repeater​',
            'permission' => true,
        ]);

        DockCategory::create([
            'name' => 'Municipality',
            'permission' => false,
        ]);
         DockCategory::create([
            'name' => 'EMS',
            'permission' => false,
        ]);

        DockCategory::create([
            'name' => 'Police',
            'permission' => false,
        ]);
         DockCategory::create([
            'name' => 'Fire',
            'permission' => false,
        ]);

        DockCategory::create([
            'name' => 'Private',
            'permission' => true,
        ]);
        DockCategory::create([
            'name' => 'Other',
            'permission' => true,
        ]);
    }
}
