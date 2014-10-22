<?php

class InventoryReceptorTableSeeder extends Seeder {

    public function run()
    {
        InventoryReceptor::create([
             'inventory_id' => 1,
             'receptors_id' => 1,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 2,
            'receptors_id' => 1,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 3,
            'receptors_id' => 1,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 4,
            'receptors_id' => 1,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 5,
            'receptors_id' => 1,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 8,
            'receptors_id' => 1,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 1,
            'receptors_id' => 2,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 2,
            'receptors_id' => 2,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 3,
            'receptors_id' => 2,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 4,
            'receptors_id' => 2,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 5,
            'receptors_id' => 2,
            'count' => 1
        ]);
        InventoryReceptor::create([
            'inventory_id' => 8,
            'receptors_id' => 2,
            'count' => 1
        ]);
    }

}