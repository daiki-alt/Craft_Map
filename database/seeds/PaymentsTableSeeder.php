<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'id'=>1,
            'payment'=>'現金',
        ]);
        
        DB::table('payments')->insert([
            'id'=>2,
            'payment'=>'クレジットカード',
        ]);
        
        DB::table('payments')->insert([
            'id'=>3,
            'payment'=>'交通系IC',
        ]);
        
        DB::table('payments')->insert([
            'id'=>4,
            'payment'=>'PayPay',
        ]);
        
    }
}
