<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Appetizers', 'slug' => 'appetizers', 'count' => 0],
            ['name' => 'Main Course', 'slug' => 'main-course', 'count' => 0],
            ['name' => 'Desserts', 'slug' => 'desserts', 'count' => 0],
            ['name' => 'Beverages', 'slug' => 'beverages', 'count' => 0],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create menu items
        $menuItems = [
            // Appetizers
            [
                'name' => 'Caesar Salad',
                'description' => 'Fresh romaine lettuce with parmesan cheese, croutons, and Caesar dressing',
                'price' => 8.99,
                'category' => 'appetizers',
                'image' => 'https://images.unsplash.com/photo-1546793665-c74683f339c1?w=400',
                'preparation_time' => 10,
                'available' => true,
                'ingredients' => 'Romaine lettuce, Parmesan cheese, Croutons, Caesar dressing',
                'allergens' => 'Dairy, Gluten',
                'is_vegetarian' => true,
                'is_vegan' => false,
                'spicy_level' => 'none'
            ],
            [
                'name' => 'Buffalo Wings',
                'description' => 'Crispy chicken wings tossed in spicy buffalo sauce',
                'price' => 12.99,
                'category' => 'appetizers',
                'image' => 'https://images.unsplash.com/photo-1608039755401-742074f0548d?w=400',
                'preparation_time' => 15,
                'available' => true,
                'ingredients' => 'Chicken wings, Buffalo sauce, Celery, Ranch dressing',
                'allergens' => 'Dairy',
                'is_vegetarian' => false,
                'is_vegan' => false,
                'spicy_level' => 'hot'
            ],
            [
                'name' => 'Garlic Bread',
                'description' => 'Toasted bread with garlic butter and herbs',
                'price' => 5.99,
                'category' => 'appetizers',
                'image' => 'https://images.unsplash.com/photo-1573140401552-3fab0b24f1cc?w=400',
                'preparation_time' => 8,
                'available' => true,
                'ingredients' => 'Bread, Garlic, Butter, Parsley',
                'allergens' => 'Gluten, Dairy',
                'is_vegetarian' => true,
                'is_vegan' => false,
                'spicy_level' => 'none'
            ],

            // Main Course
            [
                'name' => 'Grilled Salmon',
                'description' => 'Fresh Atlantic salmon with lemon butter sauce and vegetables',
                'price' => 24.99,
                'category' => 'main-course',
                'image' => 'https://images.unsplash.com/photo-1485921325833-c519f76c4927?w=400',
                'preparation_time' => 20,
                'available' => true,
                'ingredients' => 'Salmon, Lemon, Butter, Mixed vegetables',
                'allergens' => 'Fish, Dairy',
                'is_vegetarian' => false,
                'is_vegan' => false,
                'spicy_level' => 'none'
            ],
            [
                'name' => 'Beef Burger',
                'description' => 'Juicy beef patty with cheese, lettuce, tomato, and special sauce',
                'price' => 15.99,
                'category' => 'main-course',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400',
                'preparation_time' => 18,
                'available' => true,
                'ingredients' => 'Beef patty, Cheese, Lettuce, Tomato, Bun, Special sauce',
                'allergens' => 'Gluten, Dairy',
                'is_vegetarian' => false,
                'is_vegan' => false,
                'spicy_level' => 'mild'
            ],
            [
                'name' => 'Chicken Alfredo',
                'description' => 'Fettuccine pasta with grilled chicken in creamy Alfredo sauce',
                'price' => 18.99,
                'category' => 'main-course',
                'image' => 'https://images.unsplash.com/photo-1645112411341-6c4fd023714a?w=400',
                'preparation_time' => 22,
                'available' => true,
                'ingredients' => 'Fettuccine, Chicken breast, Cream, Parmesan, Garlic',
                'allergens' => 'Gluten, Dairy',
                'is_vegetarian' => false,
                'is_vegan' => false,
                'spicy_level' => 'none'
            ],
            [
                'name' => 'Vegetable Stir Fry',
                'description' => 'Fresh mixed vegetables in savory Asian sauce with rice',
                'price' => 13.99,
                'category' => 'main-course',
                'image' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=400',
                'preparation_time' => 15,
                'available' => true,
                'ingredients' => 'Bell peppers, Broccoli, Carrots, Soy sauce, Rice',
                'allergens' => 'Soy',
                'is_vegetarian' => true,
                'is_vegan' => true,
                'spicy_level' => 'medium'
            ],

            // Desserts
            [
                'name' => 'Chocolate Lava Cake',
                'description' => 'Warm chocolate cake with molten center, served with vanilla ice cream',
                'price' => 8.99,
                'category' => 'desserts',
                'image' => 'https://images.unsplash.com/photo-1606312619070-d48b4cdc7e59?w=400',
                'preparation_time' => 12,
                'available' => true,
                'ingredients' => 'Dark chocolate, Flour, Eggs, Butter, Vanilla ice cream',
                'allergens' => 'Gluten, Dairy, Eggs',
                'is_vegetarian' => true,
                'is_vegan' => false,
                'spicy_level' => 'none'
            ],
            [
                'name' => 'New York Cheesecake',
                'description' => 'Classic creamy cheesecake with graham cracker crust',
                'price' => 7.99,
                'category' => 'desserts',
                'image' => 'https://images.unsplash.com/photo-1533134442586-62531b9c09de?w=400',
                'preparation_time' => 5,
                'available' => true,
                'ingredients' => 'Cream cheese, Graham crackers, Sugar, Eggs',
                'allergens' => 'Gluten, Dairy, Eggs',
                'is_vegetarian' => true,
                'is_vegan' => false,
                'spicy_level' => 'none'
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Italian coffee-flavored dessert with mascarpone cheese',
                'price' => 9.99,
                'category' => 'desserts',
                'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=400',
                'preparation_time' => 8,
                'available' => true,
                'ingredients' => 'Ladyfingers, Mascarpone, Coffee, Cocoa powder, Eggs',
                'allergens' => 'Gluten, Dairy, Eggs',
                'is_vegetarian' => true,
                'is_vegan' => false,
                'spicy_level' => 'none'
            ],

            // Beverages
            [
                'name' => 'Fresh Orange Juice',
                'description' => 'Freshly squeezed orange juice',
                'price' => 4.99,
                'category' => 'beverages',
                'image' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400',
                'preparation_time' => 5,
                'available' => true,
                'ingredients' => 'Fresh oranges',
                'allergens' => '',
                'is_vegetarian' => true,
                'is_vegan' => true,
                'spicy_level' => 'none'
            ],
            [
                'name' => 'Iced Coffee',
                'description' => 'Cold brew coffee served over ice',
                'price' => 5.99,
                'category' => 'beverages',
                'image' => 'https://images.unsplash.com/photo-1517487881594-2787fef5ebf7?w=400',
                'preparation_time' => 3,
                'available' => true,
                'ingredients' => 'Coffee, Ice, Milk, Sugar',
                'allergens' => 'Dairy',
                'is_vegetarian' => true,
                'is_vegan' => false,
                'spicy_level' => 'none'
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }

        // Update category counts
        $categories = ['appetizers', 'main-course', 'desserts', 'beverages'];
        foreach ($categories as $slug) {
            $count = MenuItem::where('category', $slug)->count();
            Category::where('slug', $slug)->update(['count' => $count]);
        }
    }
}
