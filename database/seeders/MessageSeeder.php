<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        Message::truncate();

        $items = [
            [
                'first_name' => 'Ali',
                'last_name'  => 'Hassan',
                'email'      => 'ali.hassan@example.com',
                'message'    => 'I am interested in applying for the next accelerator cohort. Can you share more details about the application process?',
                'is_read'    => false,
            ],
            [
                'first_name' => 'Fatima',
                'last_name'  => 'Nasser',
                'email'      => 'fatima.n@example.com',
                'message'    => 'We represent a group of investors from the diaspora and would like to learn more about YAIN and how we can participate.',
                'is_read'    => true,
            ],
        ];

        Message::insert($items);
    }
}
