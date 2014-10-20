<?php

class ReceptorsTableSeeder extends Seeder {

    public function run()
    {

        Receptor::create([
            'mac' => "0013A20040AA51C4",
            'name'  => "Control Status",
            'types_id' => "1",
            'coordinators_id' => "1",
            'locations_id' => "1"
        ]);
        Receptor::create([
            'mac' => "0013A20040BB60FE",
            'name'  => "Sensor Temperatura",
            'types_id' => "2",
            'coordinators_id' => "1",
            'locations_id' => "1"
        ]);
    }
}