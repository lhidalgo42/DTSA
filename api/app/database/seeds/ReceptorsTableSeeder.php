<?php

class ReceptorsTableSeeder extends Seeder {

    public function run()
    {

        Receptor::create([
            'mac' => "0013A20040AA51DC",
            'name'  => "Mesa de Corte 1",
            'types_id' => "1",
            'coordinators_id' => "1",
            'locations_id' => "1"
        ]);
        Receptor::create([
            'mac' => "0013A20040AA549F",
            'name'  => "Mesa de Corte 2",
            'types_id' => "1",
            'coordinators_id' => "1",
            'locations_id' => "1"
        ]);
    }
}