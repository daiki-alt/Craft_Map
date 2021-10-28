<?php

use Illuminate\Database\Seeder;

class CraftStoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('craft_store')->insert([
            'craft_id'=>1 ,
            'store_id'=>1 ,
        ]);

        DB::table('craft_store')->insert([
            'craft_id'=>2 ,
            'store_id'=>1 ,
        ]);

        DB::table('craft_store')->insert([
            'craft_id'=>3 ,
            'store_id'=>1 ,
        ]);

        DB::table('craft_store')->insert([
            'craft_id'=>4 ,
            'store_id'=>1 ,
        ]);

        DB::table('craft_store')->insert([
            'craft_id'=>5 ,
            'store_id'=>1 ,
        ]);

        DB::table('craft_store')->insert([
            'craft_id'=>4 ,
            'store_id'=>2 ,
        ]);
    }
}
