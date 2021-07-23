<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'username' => 'admin',
            'role' => 'admin',
            'nama' => 'admin',
            'password' => bcrypt('rahasia')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'username' => 'adelina',
            'role' => 'user',
            'nama' => 'adelina',
            'password' => bcrypt('rahasia')
        ]);

        $user->assignRole('user');
    }
}
