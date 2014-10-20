<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        User::create([
            'email' => 'admin@mbox.cl',
            'password' => 123,
            'name' => 'Admin',
            'last_name' => 'Mbox',
            'phone' => '+56979496212'
        ]);
        User::create([
            'email' => 'leontuna@gmail.com',
            'password' => 123,
            'name' => 'Leonardo',
            'last_name' => 'Hidalgo',
            'phone' => '+56979496212'
        ]);
        User::create([
            'email' => 'hhidalgo@edithor.cl',
            'password' => 123,
            'name' => 'Hector',
            'last_name' => 'Hidalgo',
            'phone' => '+56999376052'
        ]);
        User::create([
            'email' => 'enzo.9214@gmail.com',
            'password' => 123,
            'name' => 'Luch(Enzo)',
            'last_name' => 'Scilla',
            'phone' => '+56976293787'
        ]);
        User::create([
            'email' => 'aguscovich@gmail.com',
            'password' => 123,
            'name' => 'Antonio',
            'last_name' => 'Guscovich',
            'phone' => '+56962396227'
        ]);
    }
}