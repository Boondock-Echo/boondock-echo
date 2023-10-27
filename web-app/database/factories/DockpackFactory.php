<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\dockpack>
 */
class DockpackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Dockpack::class;
    public function definition()
    {
        return [
            'pack_id' => $this->faker->randomNumber(),
            'owner' => '1',
            'enabled' => true,
        ];
    }
}
