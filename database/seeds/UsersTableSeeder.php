<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'taro' => '太郎',
            'jiro' => '次郎',
            'saburo' => '三郎',
        ];

        foreach ($names as $name_en => $name_jp) {

            DB::table('users')->insert([
                'name' => $name_jp,
                'email' => $name_en .'@example.com',
                'password' => bcrypt('aaa')
            ]);

        }
    }
}
