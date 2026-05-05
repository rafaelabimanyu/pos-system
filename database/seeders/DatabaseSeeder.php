<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@pos.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Cashier User',
            'email' => 'cashier@pos.com',
            'password' => bcrypt('password'),
            'role' => 'cashier',
        ]);

        $coffeeCategory = \App\Models\Category::create(['name' => 'Coffee', 'description' => 'Espresso-based and brewed coffee']);
        $foodCategory = \App\Models\Category::create(['name' => 'Food & Pastry', 'description' => 'Snacks and meals']);
        $beverageCategory = \App\Models\Category::create(['name' => 'Other Beverages', 'description' => 'Non-coffee drinks']);

        $products = [
            ['category_id' => $coffeeCategory->id, 'name' => 'Caffe Americano', 'price' => 25000, 'stock' => 50, 'description' => 'Classic black coffee'],
            ['category_id' => $coffeeCategory->id, 'name' => 'Cafe Latte', 'price' => 32000, 'stock' => 45, 'description' => 'Espresso with steamed milk'],
            ['category_id' => $coffeeCategory->id, 'name' => 'Cappuccino', 'price' => 32000, 'stock' => 40, 'description' => 'Espresso with thick milk foam'],
            ['category_id' => $coffeeCategory->id, 'name' => 'Caramel Macchiato', 'price' => 38000, 'stock' => 35, 'description' => 'Espresso, vanilla, milk, and caramel drizzle'],
            ['category_id' => $foodCategory->id, 'name' => 'Butter Croissant', 'price' => 22000, 'stock' => 20, 'description' => 'Flaky, buttery French pastry'],
            ['category_id' => $foodCategory->id, 'name' => 'Almond Pain au Chocolat', 'price' => 28000, 'stock' => 15, 'description' => 'Chocolate filled pastry with almonds'],
            ['category_id' => $foodCategory->id, 'name' => 'Beef Quiche', 'price' => 35000, 'stock' => 10, 'description' => 'Savory pie with beef and cheese'],
            ['category_id' => $foodCategory->id, 'name' => 'Club Sandwich', 'price' => 45000, 'stock' => 5, 'description' => 'Chicken, egg, lettuce, and mayo sandwich'],
            ['category_id' => $beverageCategory->id, 'name' => 'Iced Lemon Tea', 'price' => 20000, 'stock' => 60, 'description' => 'Refreshing black tea with lemon'],
            ['category_id' => $beverageCategory->id, 'name' => 'Matcha Latte', 'price' => 35000, 'stock' => 25, 'description' => 'Premium Japanese green tea with milk'],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
