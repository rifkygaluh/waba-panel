<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];
        
        for ($i=0; $i < 10; $i++) { 
            $users[] = [
                'name' => fake()->name(),
                'email' => fake()->email(),
                'password' => fake()->password(),
                'phone_number' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'role' => 'user',
            ];
        }

        DB::table('users')->insert($users);
    }
}
