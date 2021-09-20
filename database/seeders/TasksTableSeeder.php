<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        $tasks = [];

        for ($i = 0; $i <= 15; $i++) {
            $tasks[] = [
              'card_id' => $faker->numberBetween(1, 8),
              'name' => $faker->words(2, true),
              'created_at' => now(3),
              'updated_at' => now(3),
            ];
        }

        DB::table('tasks')->insert($tasks);
    }
}
