<?php

namespace Database\Seeders;

use App\Models\categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fantasy Section',
                'image' => 'fantasy.avif',
            ],
            [
                'name' => 'Medical Section',
                'image' => 'medical.jpg',
            ],
            [
                'name' => 'poetry section',
                'image' => 'poetry.jpg',
            ],
            [
                'name' => 'programming section',
                'image' => 'programming.jpg',
            ],
            [
                'name' => 'science section',
                'image' => 'science.jpg',
            ],
            [
                'name' => 'WWII section',
                'image' => 'WWII.jpg',
            ],
        ];

        foreach ($categories as $category) {
            categories::create($category);
        }
    }
}
