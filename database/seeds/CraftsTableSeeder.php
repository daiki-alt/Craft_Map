<?php

use Illuminate\Database\Seeder;

class CraftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crafts')->insert([
            'id'=>1,
            'type'=>'竹細工',
        ]);
        DB::table('crafts')->insert([
            'id'=>2,
            'type'=>'染物',
        ]);
        DB::table('crafts')->insert([
            'id'=>3,
            'type'=>'陶芸',
        ]);
        DB::table('crafts')->insert([
            'id'=>4,
            'type'=>'漆芸',
        ]);
        DB::table('crafts')->insert([
            'id'=>5,
            'type'=>'木工',
        ]);
    }
    
    
}
