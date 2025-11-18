<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [];
        
        for ($i=0; $i < 10; $i++) { 
            $stores[] = [
                'name' => fake()->company(),
                'code' => strtoupper(Str::random(3))
                    . '-' . strtoupper(Str::random(3)),
                'area' => fake()->city(),
            ];
        }

        DB::table('stores')->insert($stores);
    }
}
