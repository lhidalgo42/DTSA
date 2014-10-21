<?php

class SensorsTableSeeder extends Seeder {

    public function run()
    {
        Sensor::create([
            'name' => "Sencor de Corriente",
            'control'  => "0",
            'locations_id' => "1",
            'receptors_id' => "1",
            ]);
        Sensor::create([
            'name' => "Sensor de Corriente",
            'control'  => "0",
            'locations_id' => "1",
            'receptors_id' => "2",
            ]);
    }
}