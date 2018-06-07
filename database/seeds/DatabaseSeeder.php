<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
        $this->call(CollectTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
     }
}
