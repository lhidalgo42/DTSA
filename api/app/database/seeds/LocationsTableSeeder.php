<?php

class LocationsTableSeeder extends Seeder {

    public function run()
    {

        Location::create([
            'name'  => "Planta"
        ]);

    }
}