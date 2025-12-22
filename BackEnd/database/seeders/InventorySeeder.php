<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryItem;
use Carbon\Carbon;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventoryItems = [
            [
                'name' => 'Salmon Fillet',
                'category' => 'meat',
                'current_stock' => 5,
                'unit' => 'kg',
                'reorder_level' => 10,
                'supplier' => 'Ocean Fresh Co.',
                'status' => 'low_stock',
                'cost_per_unit' => 25.00,
                'last_restock_date' => Carbon::now()->subDays(3)
            ],
            [
                'name' => 'Truffle Oil',
                'category' => 'spices',
                'current_stock' => 3,
                'unit' => 'L',
                'reorder_level' => 5,
                'supplier' => 'Gourmet Imports',
                'status' => 'low_stock',
                'cost_per_unit' => 45.00,
                'last_restock_date' => Carbon::now()->subDays(7)
            ],
            [
                'name' => 'Parmesan Cheese',
                'category' => 'dairy',
                'current_stock' => 2,
                'unit' => 'kg',
                'reorder_level' => 5,
                'supplier' => 'Italian Delights',
                'status' => 'low_stock',
                'cost_per_unit' => 18.00,
                'last_restock_date' => Carbon::now()->subDays(5)
            ],
            [
                'name' => 'Fresh Basil',
                'category' => 'vegetables',
                'current_stock' => 0.5,
                'unit' => 'kg',
                'reorder_level' => 1,
                'supplier' => 'Local Farm',
                'status' => 'low_stock',
                'cost_per_unit' => 8.00,
                'last_restock_date' => Carbon::now()->subDays(2)
            ],
            [
                'name' => 'Beef Patties',
                'category' => 'meat',
                'current_stock' => 25,
                'unit' => 'kg',
                'reorder_level' => 10,
                'supplier' => 'Prime Meats',
                'status' => 'in_stock',
                'cost_per_unit' => 12.00,
                'last_restock_date' => Carbon::now()->subDays(1)
            ],
            [
                'name' => 'Lettuce',
                'category' => 'vegetables',
                'current_stock' => 8,
                'unit' => 'kg',
                'reorder_level' => 5,
                'supplier' => 'Green Valley Farms',
                'status' => 'in_stock',
                'cost_per_unit' => 3.50,
                'last_restock_date' => Carbon::now()->subDays(1)
            ],
            [
                'name' => 'Tomatoes',
                'category' => 'vegetables',
                'current_stock' => 12,
                'unit' => 'kg',
                'reorder_level' => 8,
                'supplier' => 'Sunshine Produce',
                'status' => 'in_stock',
                'cost_per_unit' => 4.00,
                'last_restock_date' => Carbon::now()->subDays(1)
            ],
            [
                'name' => 'Cooking Oil',
                'category' => 'other',
                'current_stock' => 15,
                'unit' => 'L',
                'reorder_level' => 5,
                'supplier' => 'Chef\'s Choice',
                'status' => 'in_stock',
                'cost_per_unit' => 6.00,
                'last_restock_date' => Carbon::now()->subDays(4)
            ],
            [
                'name' => 'Mozzarella Cheese',
                'category' => 'dairy',
                'current_stock' => 0,
                'unit' => 'kg',
                'reorder_level' => 8,
                'supplier' => 'Italian Delights',
                'status' => 'out_of_stock',
                'cost_per_unit' => 15.00,
                'last_restock_date' => Carbon::now()->subDays(10)
            ],
            [
                'name' => 'Orange Juice',
                'category' => 'beverages',
                'current_stock' => 24,
                'unit' => 'bottles',
                'reorder_level' => 12,
                'supplier' => 'Fresh Squeezed Co.',
                'status' => 'in_stock',
                'cost_per_unit' => 2.50,
                'last_restock_date' => Carbon::now()->subDays(2)
            ],
            [
                'name' => 'Chicken Breast',
                'category' => 'meat',
                'current_stock' => 18,
                'unit' => 'kg',
                'reorder_level' => 10,
                'supplier' => 'Prime Meats',
                'status' => 'in_stock',
                'cost_per_unit' => 9.00,
                'last_restock_date' => Carbon::now()->subDays(1)
            ],
            [
                'name' => 'Pasta',
                'category' => 'other',
                'current_stock' => 30,
                'unit' => 'kg',
                'reorder_level' => 15,
                'supplier' => 'Italian Delights',
                'status' => 'in_stock',
                'cost_per_unit' => 3.00,
                'last_restock_date' => Carbon::now()->subDays(6)
            ],
            [
                'name' => 'Olive Oil',
                'category' => 'other',
                'current_stock' => 10,
                'unit' => 'L',
                'reorder_level' => 5,
                'supplier' => 'Gourmet Imports',
                'status' => 'in_stock',
                'cost_per_unit' => 12.00,
                'last_restock_date' => Carbon::now()->subDays(8)
            ],
            [
                'name' => 'Garlic',
                'category' => 'vegetables',
                'current_stock' => 2,
                'unit' => 'kg',
                'reorder_level' => 3,
                'supplier' => 'Local Farm',
                'status' => 'low_stock',
                'cost_per_unit' => 5.00,
                'last_restock_date' => Carbon::now()->subDays(4)
            ],
            [
                'name' => 'Black Pepper',
                'category' => 'spices',
                'current_stock' => 1.5,
                'unit' => 'kg',
                'reorder_level' => 1,
                'supplier' => 'Spice World',
                'status' => 'in_stock',
                'cost_per_unit' => 20.00,
                'last_restock_date' => Carbon::now()->subDays(15)
            ]
        ];

        foreach ($inventoryItems as $item) {
            InventoryItem::create($item);
        }
    }
}
