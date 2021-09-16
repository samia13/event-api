<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Event, Tag, User};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tags =  Tag::factory(10)->create();
        User::factory(10)->create()->each(function($user) use ($tags){
            Event::factory(rand(2,4))->create([
                'user_id' => $user->id
            ])->each(function($event) use ($tags){
                $event->tags()->attach($tags->random(3));
            });
        });
    }
}
