<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prices;
use App\Models\User;
use App\Models\Contact;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prices::create([
        'rate_dollar' => '90',
        'price_delivery' => '4.5',
    ]);

        Contact::create([
            'whatsapp' => '123456789',
            'tel' => '987654321',
            'addres_a' => 'Address A',
            'addres_b' => 'Address B',
            'mail' => 'example@example.com',
            'grafic' => 'Monday - Friday: 9 AM - 5 PM',
        ]);

        User::create([
        'name' => 'Администратор',
        'number' => '555000555',
        'email' => 'admin@gmail.com',
        'password' => ('admin'),
        'role' => 'admin',
    ]);
    }
}
