<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'uuid' => '372a9c43-26cd-432f-bb25-a0eb335815b7',
            'user_id' => '1',
            'item_id' => '1',
            'quantity' => '2'
        ];
        $order = new Order;
        $order->fill($param)->save();

        $param = [
            'uuid' => '043a9c43-26cd-432f-bb25-a0eb045815b7',
            'user_id' => '1',
            'item_id' => '1',
            'quantity' => '1'
        ];
        $order = new Order;
        $order->fill($param)->save();
    }
}
