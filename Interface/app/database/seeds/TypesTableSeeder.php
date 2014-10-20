<?php

class TypesTableSeeder extends Seeder {

    public function run()
    {
            Type::create([

                'name' => "Control Simple",
                'parameter'  => "dio-0 : dio-1 : dio-2 : dio-3 : dio-4 : dio-5 : dio-6 : dio-7",
                'example' => "1:1:0:0:1:0:0:0"
            ]);
            Type::create([
                'name' => "Sensor Temperatura",
                "parameter" => "Sign : integer : decimal",
                'example' => "00 : 13 : 62"
            ]);
    }
}