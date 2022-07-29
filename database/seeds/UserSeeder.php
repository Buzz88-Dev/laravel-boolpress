<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'omar',
                'email' => 'omar@gmail.com',
                'password' => Hash::make('omar1988'), // metodo per creare le password
            ],

            [
                'name' => 'qwer',
                'email' => 'qwer@qwer.qwer',
                'password' => Hash::make('qwer'),
            ],

            [
                'name' => 'zxcv',
                'email' => 'zxcv@zxcv.zxcv',
                'password' => Hash::make('zxcv'),
            ],
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
