<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $faker = Factory::create();
        $category = ["accessories" ,"components" ,"software" ,"Electronics"];
        foreach ($category as $key => $categories) {
            Category::create([
                "name" => $categories,
                "status" => $faker->randomElement(['active','inactive']),
                "description" => $faker->paragraph()
            ]);
        }
    }
}
