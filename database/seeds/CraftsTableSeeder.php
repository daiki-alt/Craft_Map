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
            'image_file' => '/images/493851AF-99FD-4E93-91AB-93884FACAF99_1080x.webp'
        ]);
        DB::table('crafts')->insert([
            'id'=>2,
            'type'=>'染物',
            'image_file' => '/images/download.jpg'
        ]);
        DB::table('crafts')->insert([
            'id'=>3,
            'type'=>'陶芸',
            'image_file' => '/images/3faf9464-515b-4eaa-8e36-40344245fe3e.webp'
        ]);
        DB::table('crafts')->insert([
            'id'=>4,
            'type'=>'漆芸',
            'image_file' => '/images/image_050aedd3-2e1d-4cd0-b42c-cef88491a301_590x.webp'
        ]);
        DB::table('crafts')->insert([
            'id'=>5,
            'type'=>'木工',
            'image_file' => '/images/unnamed.jpg'
        ]);
        DB::table('crafts')->insert([
            'id'=>6,
            'type'=>'その他',
            'image_file' => '/images/財布.jpg'
        ]);
    }
    
    
}
