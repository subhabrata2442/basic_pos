<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '1234567899',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('password'),
            'role' => 1,
            'status' => 1,
        ]);
        User::factory(15)->create();
    }
}
