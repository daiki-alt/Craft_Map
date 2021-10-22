<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            'id'=>1,
            'name'=>'駿河の工房　匠宿',
            'work_type'=>'販売と体験',
            'address'=>'静岡県静岡市駿河区丸子3240-1',
            'lat' => '34.95361760276212',
            'lng' => '138.33336521292009',
            'telephone_number'=>'0542851177',
            'start_hours'=>'10:00',
            'end_hours'=>'19:00',
        ]);
        
        DB::table('stores')->insert([
            'id'=>2,
            'name'=>'金剛石目塗鳥羽漆芸',
            'work_type'=>'販売',
            'address'=>'静岡県静岡市駿河区大坪1-3',
            'lat' => '34.96667419951148',
            'lng' => '138.39463709942694',
            'telephone_number'=>'0542561521',
            'start_hours'=>'12:00',
            'end_hours'=>'20:00',
        ]);
        
    }
}
