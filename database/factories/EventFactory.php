<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use illuminate\Support\Str;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(2,5));
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->sentence(rand(6,12)),
            'premium' => $this->faker->boolean(25),
            'start_at' => $this->faker->dateTimeBetween('now', '+1 months'),
            'ends_at' => $this->faker->dateTimeBetween('+2 months', '+3 months')
        ];
    }
}
