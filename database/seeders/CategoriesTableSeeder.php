<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create top-level categories
        for ($i = 0; $i < 10; $i++) {
            $imageNumber = rand(1, 10);
            $iconPath = 'demo/' . $imageNumber . '.jpg';
            $bannerPath = 'demo/' . $imageNumber . '.jpg';
        
            DB::table('categories')->insert([
                'title' => $faker->word,
                'description' => $faker->sentence,
                'parent_id' => null,
                'icon_path' => $iconPath,
                'banner_path' => $bannerPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        

        // Create subcategories
        $categories = DB::table('categories')->pluck('id')->toArray();
        foreach ($categories as $categoryId) {
            for ($i = 0; $i < 3; $i++) {

                $imageNumber = rand(1, 10);
                $iconPath = 'demo/' . $imageNumber . '.jpg';
                $bannerPath = 'demo/' . $imageNumber . '.jpg';

                DB::table('categories')->insert([
                    'title' => $faker->word,
                    'description' => $faker->sentence,
                    'parent_id' => $categoryId,
                    'icon_path' => $iconPath,
                    'banner_path' => $bannerPath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
