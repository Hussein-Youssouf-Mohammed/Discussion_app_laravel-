<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'Hussein Youssouf',
            'email' => 'hussein@gmail.com',
            'admin' => 1,
            'avatar' => asset('avatars\hussein.jpg'),
            'password' => bcrypt('mohammed')
        ]);

        User::create([
            'name'=> 'Nader Youssouf',
            'email' => 'nader@gmail.com',
            'avatar' => asset('avatars\nader.jpg'),
            'password' => bcrypt('mohammed')
        ]);
    
    }
}
