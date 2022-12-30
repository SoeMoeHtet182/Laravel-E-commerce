<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
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
            'display_name' => 'user one',
            'full_name' => 'Kim Da Mi',
            'email' => 'user@a.com',
            'phone' => '09-987-899-234',
            'address' => 'No,18/KhaYay Road',
            'city' => 'Yangon',
            'postal_code' => 100302,
            'image' => 'userone.jpg',
            'suspended' => 0,
            'password' => Hash::make('password')
        ]);

        //admin
        Admin::create([
            'name' => 'adminone',
            'email' => 'admin@a.com',
            'image' => 'userone.jpg',
            'password' => Hash::make('password'),
            'address' => 'No,18/KhaYay Road',
            'city' => 'Yangon',
            'postal_code' => 100302,
            'role' => 'Developer'
        ]);

        // //category
        // $categories = ['T-Shirt', 'Shoes', 'Jeans', 'Mobile', 'Earphone', 'Electronic', 'Watch', 'Men', 'Women'];
        // foreach ($categories as $category) {
        //     Category::create([
        //         'slug' => Str::slug($category),
        //         'name' => $category,
        //         'mm_name' => ''
        //     ]);
        // }

        // //brand
        // $brands = ['Calvin-Kelin', 'Gucci', 'Addias', 'Huawei', 'Samsung', 'Apple'];
        // foreach ($brands as $brand) {
        //     Brand::create([
        //         'slug' => Str::slug($brand),
        //         'image' => '',
        //         'name' => $brand
        //     ]);
        // }

        // // color
        // $colors = ['White', 'Black', 'Red', 'Green', 'Blue', 'Violet'];
        // foreach ($colors as $color) {
        //     Color::create([
        //         'slug' => Str::slug($color),
        //         'name' => $color
        //     ]);
        // }

        // //supplier
        // Supplier::create([
        //     'name' => 'supplierone',
        //     'image' => 'supplier.png',
        //     'description' => 'absdf'
        // ]);
    }
}
