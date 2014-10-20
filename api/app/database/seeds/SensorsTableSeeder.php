<?php

class SensorsTableSeeder extends Seeder {

    public function run()
    {
        Sensor::create([
            'name' => "Sensor de Temperatura",
            'control'  => "0",
            'locations_id' => "1",
            'receptors_id' => "2",
            ]);
        Sensor::create([
            'name' => "Sensor de Humedad",
            'control'  => "0",
            'locations_id' => "1",
            'receptors_id' => "2",
            ]);
        Sensor::create([
            'name' => "dio-0",
            'python_name' => 0,
            'control'  => "1",
            'locations_id' => "1",
            'receptors_id' => "1",
            ]);
        Sensor::create([
            'name' => "dio-1",
            'python_name' => 1,
            'control'  => "1",
            'locations_id' => "1",
            'receptors_id' => "1",
            ]);
        Sensor::create([
            'name' => "dio-2",
            'python_name' => 2,
            'control'  => "1",
            'locations_id' => "1",
            'receptors_id' => "1",
            ]);
        Sensor::create([
            'name' => "dio-3",
            'python_name' => 3,
            'control'  => "1",
            'locations_id' => "1",
            'receptors_id' => "1",
            ]);
        Sensor::create([
            'name' => "dio-4",
            'python_name' => 4,
            'control'  => "1",
            'locations_id' => "1",
            'receptors_id' => "1",
            ]);
        Sensor::create([
            'name' => "dio-5",
            'python_name' => 5,
            'control'  => "1",
            'locations_id' => "1",
            'receptors_id' => "1",
            ]);
        Sensor::create([
            'name' => "dio-6",
            'python_name' => 6,
            'control'  => "1",
            'locations_id' => "1",
            'receptors_id' => "1",
            ]);
        Sensor::create([
            'name' => "dio-7",
            'python_name' => 7,
            'control'  => "1",
            'locations_id' => "1",
            'receptors_id' => "1",
            ]);
    }
}