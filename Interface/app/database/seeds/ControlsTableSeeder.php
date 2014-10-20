<?php

class ControlsTableSeeder extends Seeder {

    public function run()
    {
        Control::create([
            'sensors_id' => 8,
            'value' => 1,
            'status' => 1
        ]);
        Control::create([
            'sensors_id' => 8,
            'value' => 0,
            'status' => 1
        ]);
        Control::create([
            'sensors_id' => 8,
            'value' => 1,
            'status' => 1
        ]);
        Control::create([
            'sensors_id' => 8,
            'value' => 0,
            'status' => 1
        ]);
        Control::create([
            'sensors_id' => 8,
            'value' => 1,
            'status' => 1
        ]);
        Control::create([
            'sensors_id' => 8,
            'value' => 0,
            'status' => 1
        ]);
    }
}