<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StoreTableSeeder::class);
        $this->call(CraftsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(CraftStoreTableSeeder::class);
        $this->call(PaymentStoreTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
