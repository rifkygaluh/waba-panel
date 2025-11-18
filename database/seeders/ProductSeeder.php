<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];
        
        for ($i=0; $i < 10; $i++) { 
            $products[] = [
                'name' => fake()->sentence(),
                'description' => fake()->sentences(asText: true),
                'price' => rand(1, 10) * 10000,
                'unique_code' => strtoupper(Str::random(4))
                    . '-' . strtoupper(Str::random(4))
                    . '-' . strtoupper(Str::random(4)),
            ];
        }

        DB::table('products')->insert($products);
    }
}
