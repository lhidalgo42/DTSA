<?php

class TypesTableSeeder extends Seeder {

    public function run()
    {
            Type::create([

                'name' => "Sensor Simple",
                'parameter'  => "Sing : Integer : decimal",
                'example' => "1:1:0:0:1:0:0:0"
            ]);

    }
}