<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'التقويم','code'=>'calendar'],
            ['name' => 'المقاضي','code'=>'needs'],
            ['name' => 'المهام','code'=>'tasks'],
            ['name' => 'الأمنيات','code'=>'wishlist'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}
