<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use Faker\Factory as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Message::create([
                'recipient' => $faker->numerify('+1###########'),
                'content' => $faker->sentence(10),
                'is_sent' => false,
                'message_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
