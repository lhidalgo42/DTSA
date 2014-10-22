<?php

class TypesTableSeeder extends Seeder {

    public function run()
    {
            Type::create([

                'name' => "Sensor Simple ( Recive un sensor)",
                'parameter'  => "Signo (00 => '+',01 => '-') : Entero (Hexadecimal) : Decimal (Hexadecimal)",
                'example' => "00:1F:A1"
            ]);
        Type::create([

            'name' => "Sensor Doble ( Recive 2 sensores)",
            'parameter'  => "Signo (00 => '+',01 => '-') : Entero (Hexadecimal) : Decimal (Hexadecimal) : Signo (00 => '+',01 => '-') : Entero (Hexadecimal) : Decimal (Hexadecimal)",
            'example' => "00:1F:A1:01:AE:B2"
        ]);

    }
}