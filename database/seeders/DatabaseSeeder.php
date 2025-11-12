<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Retentia Admin',
            'email' => 'admin@retentia.com',
            'password' => 'password',
            'phone_number' => 0,
            'role' => 'admin',
        ]);
        
        $this->call(UserSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(InvoiceSeeder::class);
    }
}
