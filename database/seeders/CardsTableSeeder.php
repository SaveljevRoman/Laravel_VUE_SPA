<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        $cards = [];

        for ($i = 0; $i <= 7; $i++) {
            $cards[] = [
                'desk_list_id' => $faker->numberBetween(1, 4),
                'name' => $faker->words(2, true),
                'created_at' => now(3),
                'updated_at' => now(3),
            ];
        }

        DB::table('cards')->insert($cards);
    }
}
