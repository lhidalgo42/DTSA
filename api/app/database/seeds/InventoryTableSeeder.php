<?php

class InventoryTableSeeder extends Seeder {

    public function run()
    {
        Inventory::create([
            'name' => 'Arduino Uno R3',
            'sku' => 'MCI-TDD-00756',
            'mfg' => 'A000066',
            'url' => 'http://www.olimex.cl/product_info.php?products_id=756&product__name=Arduino_Uno_R3',
            'store' => 'MCI Olimex'
        ]);
        Inventory::create([
            'name' => 'XBee Shield',
            'sku' => 'MCI-TDD-00691',
            'mfg' => 'WRL-09976',
            'url' => 'http://www.olimex.cl/product_info.php?products_id=691&product__name=XBee_Shield',
            'store' => 'MCI Olimex'
        ]);
        Inventory::create([
            'name' => 'XBee Pro 60mW PCB Antena (Serie 1)',
            'sku' => 'MCI-WIR-01082',
            'mfg' => 'XBP24-API-001',
            'url' => 'http://www.olimex.cl/product_info.php?products_id=1082&product__name=XBee_Pro_60mW_PCB_Antena_(Serie_1)',
            'store' => 'MCI Olimex'
        ]);
        Inventory::create([
            'name' => 'Pin Header 40 pines',
            'sku' => 'MCI-PRT-00177',
            'mfg' => 'PRT-00116',
            'url' => 'http://www.olimex.cl/product_info.php?products_id=177&product__name=Pin_Header_40_pines',
            'store' => 'MCI Olimex'
        ]);
        Inventory::create([
            'name' => 'Conector hembra 40 Pines PCB',
            'sku' => 'MCI-PRT-00540',
            'mfg' => 'FHEADS40',
            'url' => 'http://www.olimex.cl/product_info.php?products_id=540&product__name=Conector_hembra_40_Pines_PCB',
            'store' => 'MCI Olimex'
        ]);
        Inventory::create([
            'name' => 'Raspberry Pi - Modelo B+ c/memoria 8GB SDCard',
            'sku' => 'MCI-TDD-01584',
            'mfg' => 'RASPBERRY-MODB+/8GB-USD',
            'url' => 'http://www.olimex.cl/product_info.php?products_id=1584&product__name=Raspberry_Pi_Modelo_B+_c_memoria_8GB_SDCard',
            'store' => 'MCI Olimex'
        ]);
        Inventory::create([
            'name' => 'Cable HDMI de 1 metro',
            'sku' => 'MCI-ACC-01241',
            'mfg' => '3871',
            'url' => 'http://www.olimex.cl/product_info.php?products_id=1241&product__name=Cable_HDMI_de_1_metro',
            'store' => 'MCI Olimex'
        ]);
        Inventory::create([
            'name' => 'TRANSFORMADOR, 0-100 AMP AC',
            'url' => 'http://www.unisource.cl/ctv-c.html',
            'store' => 'Unisource'
        ]);

    }
}