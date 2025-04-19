<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        Message::create(['content' => '這是第一則假留言！']);
        Message::create(['content' => 'Laravel 很好用！']);
        Message::create(['content' => 'Seeder 真的太方便了 😎']);
    }
}
