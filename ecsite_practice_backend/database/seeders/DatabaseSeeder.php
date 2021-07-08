<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ItemsTableSeeder::class);
        //$this->call(UsersTableSeeder::class);

        \App\Models\Item::factory(10)->create();
        //\App\Models\Order::factory(5)->create();
    }
}
