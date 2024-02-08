<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    User::create([
        'name' => 'Администратор',
        'number' => '555000555',
        'email' => 'admin@gmail.com',
        'password' => ('admin'),
        'role' => 'admin',
    ]);
}

}
