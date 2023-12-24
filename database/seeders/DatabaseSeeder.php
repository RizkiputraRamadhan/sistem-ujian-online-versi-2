<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'typeuser' => '1',
            'password' => bcrypt('12345678'),
        ]);
      
    }
}
