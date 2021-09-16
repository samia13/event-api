<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            // 'id' => $this->id,
            // 'title' => $this->id,
            // 'slug' => Str::slug($title),
            // 'content' => $this->faker->sentence(rand(6,12)),
            // 'premium' => $this->faker->boolean(25),
            // 'start_at' => $this->faker->dateTimeBetween('now', '+1 months'),
            // 'ends_at' => $this->faker->dateTimeBetween('+2 months', '+3 months')
        ];

    }
}
