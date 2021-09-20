<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeskListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        $deskLists = [];

        for ($i = 0; $i <= 3; $i++) {

            $deskLists[] = [
                'desk_id' => $faker->numberBetween(1, 2),
                'name' => $faker->words(2, true),
                'created_at' => now(3),
                'updated_at' => now(3),
            ];
        }

        DB::table('desk_lists')->insert($deskLists);
    }
}
