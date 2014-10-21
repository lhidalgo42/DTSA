<?php

class CoordinatorsTableSeeder extends Seeder {

    public function run()
    {

        Coordinator::create([

            'mac' => "0013A20040AA51AE",
            'name'  => "Raspberry",
            'location_id' => 1,
            'users_id' => 1

        ]);

    }
}