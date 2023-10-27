<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Alert;
use Illuminate\Database\Seeder;

class AlertsTableSeeder extends Seeder
{
    public function run()
    {
        // Retrieve the user with ID 16
        $user = User::find(5);

        // Create an alert for the user
        Alert::create([
            'user_id' => $user->id,
            'message' => 'This is an alert for user ' . $user->name,
        ]);
    }
}