<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        $desks = [];

        for ($i = 0; $i <= 1; $i++) {
            $desks[] = [
                'name' => $faker->words(2, true),
                'created_at' => now(3),
                'updated_at' => now(3),
            ];
        }

        DB::table('desks')->insert($desks);
    }
}
