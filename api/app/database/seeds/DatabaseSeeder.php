<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('UsersTableSeeder');
		$this->call('CoordinatorsTableSeeder');
        $this->call('SensorsTableSeeder');
        $this->call('TypesTableSeeder');
        $this->call('ReceptorsTableSeeder');
        $this->call('LocationsTableSeeder');
        $this->call('ValuesTableSeeder');
        $this->call('ControlsTableSeeder');
	}

}
