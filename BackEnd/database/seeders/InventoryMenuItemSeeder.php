<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\InventoryItem;

class InventoryMenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Links menu items to their required inventory ingredients
     */
    public function run(): void
    {
        // Example linkages - customize based on your menu items
        
        // Find menu items by name (adjust these based on your actual menu items)
        $grilledSalmon = MenuItem::where('name', 'LIKE', '%Salmon%')->first();
        $burger = MenuItem::where('name', 'LIKE', '%Burger%')->first();
        $pasta = MenuItem::where('name', 'LIKE', '%Pasta%')->first();
        $salad = MenuItem::where('name', 'LIKE', '%Salad%')->first();
        
        // Find inventory items
        $salmonFillet = InventoryItem::where('name', 'Salmon Fillet')->first();
        $beefPatties = InventoryItem::where('name', 'Beef Patties')->first();
        $lettuce = InventoryItem::where('name', 'Lettuce')->first();
        $tomatoes = InventoryItem::where('name', 'Tomatoes')->first();
        $pastaItem = InventoryItem::where('name', 'Pasta')->first();
        $parmesanCheese = InventoryItem::where('name', 'Parmesan Cheese')->first();
        $basil = InventoryItem::where('name', 'Fresh Basil')->first();
        $oliveOil = InventoryItem::where('name', 'Olive Oil')->first();
        
        // Link Grilled Salmon dish to Salmon Fillet
        if ($grilledSalmon && $salmonFillet) {
            $grilledSalmon->inventoryItems()->attach($salmonFillet->id, [
                'quantity_required' => 0.2  // 200g salmon per serving
            ]);
            echo "✅ Linked Salmon dish to Salmon Fillet (200g per serving)\n";
        }
        
        // Link Burger to Beef Patties, Lettuce, Tomatoes
        if ($burger && $beefPatties) {
            $burger->inventoryItems()->attach($beefPatties->id, [
                'quantity_required' => 0.15  // 150g beef per burger
            ]);
            echo "✅ Linked Burger to Beef Patties (150g per serving)\n";
        }
        
        if ($burger && $lettuce) {
            $burger->inventoryItems()->attach($lettuce->id, [
                'quantity_required' => 0.05  // 50g lettuce per burger
            ]);
            echo "✅ Linked Burger to Lettuce (50g per serving)\n";
        }
        
        if ($burger && $tomatoes) {
            $burger->inventoryItems()->attach($tomatoes->id, [
                'quantity_required' => 0.08  // 80g tomatoes per burger
            ]);
            echo "✅ Linked Burger to Tomatoes (80g per serving)\n";
        }
        
        // Link Pasta dish to Pasta, Parmesan, Basil, Olive Oil
        if ($pasta && $pastaItem) {
            $pasta->inventoryItems()->attach($pastaItem->id, [
                'quantity_required' => 0.2  // 200g pasta per serving
            ]);
            echo "✅ Linked Pasta dish to Pasta (200g per serving)\n";
        }
        
        if ($pasta && $parmesanCheese) {
            $pasta->inventoryItems()->attach($parmesanCheese->id, [
                'quantity_required' => 0.03  // 30g parmesan per serving
            ]);
            echo "✅ Linked Pasta to Parmesan (30g per serving)\n";
        }
        
        if ($pasta && $basil) {
            $pasta->inventoryItems()->attach($basil->id, [
                'quantity_required' => 0.01  // 10g basil per serving
            ]);
            echo "✅ Linked Pasta to Basil (10g per serving)\n";
        }
        
        if ($pasta && $oliveOil) {
            $pasta->inventoryItems()->attach($oliveOil->id, [
                'quantity_required' => 0.02  // 20ml olive oil per serving
            ]);
            echo "✅ Linked Pasta to Olive Oil (20ml per serving)\n";
        }
        
        // Link Salad to Lettuce, Tomatoes
        if ($salad && $lettuce) {
            $salad->inventoryItems()->attach($lettuce->id, [
                'quantity_required' => 0.15  // 150g lettuce per salad
            ]);
            echo "✅ Linked Salad to Lettuce (150g per serving)\n";
        }
        
        if ($salad && $tomatoes) {
            $salad->inventoryItems()->attach($tomatoes->id, [
                'quantity_required' => 0.1  // 100g tomatoes per salad
            ]);
            echo "✅ Linked Salad to Tomatoes (100g per serving)\n";
        }
        
        echo "\n✅ Inventory-Menu Item linkages completed!\n";
        echo "📝 Note: Adjust the menu item names in the seeder to match your actual menu items.\n";
    }
}
