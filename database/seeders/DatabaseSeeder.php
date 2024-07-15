<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'last_name' => 'admin',
             'password' => 'password',
             'email' => 'admin@example.com',
             'noTelp'=> '11111111111',
             'role'=> 'admin',
         ]);

         \App\Models\User::factory()->create([
            'name' => 'Pemodal',
            'last_name' => 'pemodal',
            'password' => 'password',
            'email' => 'pemodal@example.com',
            'noTelp'=> '11111111111',
            'role'=> 'pemodal',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Pemilik',
            'last_name' => 'Usaha',
            'password' => 'password',
            'email' => 'pemilik_usaha@example.com',
            'noTelp'=> '11111111111',
            'role'=> 'pemilik_usaha',
        ]);

         
         
    }
}
