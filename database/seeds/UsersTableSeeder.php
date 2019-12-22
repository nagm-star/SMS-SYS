<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'nagm yousif',
            'email' => 'info@sms.com',
            'password' => Hash::make('password'),
            'admin' => 1,
            'phone' => '0916216314',
            'avatar' => '1.png',
        ]);

    }
}
