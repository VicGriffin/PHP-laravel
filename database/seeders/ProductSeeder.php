<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create(['name' => 'Notebook', 'selling_price' => 4.50, 'quantity' => 30, 'low_stock_level' => 5]);
        Product::create(['name' => 'Blue Pen', 'selling_price' => 1.25, 'quantity' => 4, 'low_stock_level' => 5]);
        Product::create(['name' => 'Stapler', 'selling_price' => 8.99, 'quantity' => 12, 'low_stock_level' => 3]);
        Product::create(['name' => 'Desk Lamp', 'selling_price' => 15.50, 'quantity' => 2, 'low_stock_level' => 5]);
        Product::create(['name' => 'Paper Ream', 'selling_price' => 6.75, 'quantity' => 20, 'low_stock_level' => 5]);
    }
}
