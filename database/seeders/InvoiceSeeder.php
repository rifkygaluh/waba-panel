<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = DB::table('stores')->limit(10)->get();
        $invoices = [];

        foreach ($stores as $store) {
            for ($i=0; $i < rand(1, 5); $i++) { 
                $user = DB::table('users')->inRandomOrder()->first();
                
                $invoices[] = [
                    'user_id' => $user->id,
                    'store_id' => $store->id,
                    'invoice_number' => 'INV'
                        . '-' . rand(1000, 9999)
                        . '-' . rand(100, 999),
                    'media_url' => 'https://picsum.photos/300/200',
                ];
            }
        }

        DB::table('invoices')->insert($invoices);
    }
}
