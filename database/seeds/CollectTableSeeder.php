<?php

use Illuminate\Database\Seeder;

class CollectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user_ids=[1,2,3];
        $idiom_ids=[
            [10,20,30,40,50,60],
            [70,80,90,100,110,120],
            [71,72,73,74,75,76],
        ];

        foreach ($idiom_ids as $i=> $ids){
            foreach ($ids as $id){
                \App\Models\Collection::create([
                    'user_id'=>$user_ids[$i],
                    'idiom_id'=>$id,
                    'level_id'=>random_int(1,7),
                ]);
            }
        }
  }
}
