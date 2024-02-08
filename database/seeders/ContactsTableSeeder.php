<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'whatsapp' => '123456789',
            'tel' => '987654321',
            'addres_a' => 'Address A',
            'addres_b' => 'Address B',
            'mail' => 'example@example.com',
            'grafic' => 'Monday - Friday: 9 AM - 5 PM',
        ]);
    }
}
