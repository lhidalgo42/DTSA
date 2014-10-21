<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        User::create([
            'email' => 'ccostano@dtsa.cl',
            'password' => 123,
            'name' => 'Carlos',
            'last_name' => 'de Costanora',
            'phone' => '+569'
        ]);
        User::create([
            'email' => 'leontuna@gmail.com',
            'password' => 123,
            'name' => 'Leonardo',
            'last_name' => 'Hidalgo',
            'phone' => '+56979496212'
        ]);
    }
}