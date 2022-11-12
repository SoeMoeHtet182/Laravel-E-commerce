<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'userone',
            'email' => 'user@a.com',
            'password' => Hash::make('password')
        ]);

        //admin
        Admin::create([
            'name' => 'adminone',
            'email' => 'admin@a.com',
            'password' => Hash::make('password')
        ]);

        //category
        $categories = ['T-Shirt', 'Hat', 'Jeans', 'Mobile', 'Earphone', 'Electronic'];
        foreach ($categories as $category) {
            Category::create([
                'slug' => Str::slug($category),
                'name' => $category
            ]);
        }

        //brand
        $brands = ['Calvin-Kelin', 'Gucci', 'Addias', 'Huawei', 'Samsung', 'Apple'];
        foreach ($brands as $brand) {
            Brand::create([
                'slug' => Str::slug($brand),
                'name' => $brand
            ]);
        }

        // color
        $colors = ['White', 'Black', 'Red', 'Green', 'Blue', 'Violet'];
        foreach ($colors as $color) {
            Color::create([
                'slug' => Str::slug($color),
                'name' => $color
            ]);
        }

        //supplier
        Supplier::create([
            'name' => 'supplierone',
            'image' => 'supplier.png',
            'description' => 'absdf'
        ]);
    }
}
