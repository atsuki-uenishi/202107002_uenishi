<?php

namespace Database\Seeders;

use App\Models\User;
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
        $param = [
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => '000000'
        ];
        $user = new User;
        $user->fill($param)->save();

    }
}
