<?php

namespace Database\Factories;

use App\Models\BusinessAccount;
use App\Models\Category;
use App\Models\Country;
use Faker\Factory as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessAccount>
 */
class BusinessAccountFactory extends Factory
{
    protected $model = BusinessAccount::class;

   
        public function definition()
        {
            $faker = Faker::create();

            return [
                'user_id' => function () {
                    return \App\Models\User::factory()->create()->id;
                },
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'username' => $this->faker->userName,
                'description' => $this->faker->paragraph,
                'phone_number' => $this->faker->phoneNumber,
                'businessName' => $this->faker->company,
                'websiteUrl' => $this->faker->url,
                'verification_option' => function () {
                    return \App\Models\VerificationMethod::factory()->create()->id;
                },
                'specialization' => $this->faker->jobTitle,
                'category_id' => function () {
                    $category = Category::whereNull('parent_id')->inRandomOrder()->first();
                    return $category ? $category->id : null;
                },
                'sub_category_id' => function (array $attributes) {
                    if (isset($attributes['category_id'])) {
                        $subCategory = Category::where('parent_id', $attributes['category_id'])->inRandomOrder()->first();
                        return $subCategory ? $subCategory->id : null;
                    }
                    return null;
                },
                'country_id' => Country::inRandomOrder()->first()->id,
                'business_image' => function () use ($faker) {
                    $imageNumber = rand(1, 10);
                    return 'demo/' . $imageNumber . '.jpg'; 
                },
                'is_approved' => $this->faker->boolean,
                'is_verified' => $this->faker->boolean,
                'individual_or_business' => $this->faker->randomElement(['individual', 'business']),
                'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ];
            
        }
    
}
