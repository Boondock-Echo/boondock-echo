<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DockCategorySeeder::class,
            CreateSuperAdminSeeder::class,
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
           
            // add more seeders as needed
        ]);
    }
}
