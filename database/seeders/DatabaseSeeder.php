<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BusinessAccount;
use App\Models\BusinessReview;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UsersTableSeeder::class,
            CountrySeeder::class,
            CurrencySeeder::class,
            SettingsTableSeeder::class,
            CategoriesTableSeeder::class

        ]);


        $businessAccounts = BusinessAccount::factory(75)->create();

        foreach ($businessAccounts as $businessAccount) {
            $users = User::where('is_admin', 0)->where('has_business_account', 1)->inRandomOrder()->get();
            
            foreach ($users as $user) {
                // Check if the user has already added a review for this business account
                if (!BusinessReview::where('user_id', $user->id)->where('business_account_id', $businessAccount->id)->exists()) {
                    $faker = Faker::create();
                    BusinessReview::create([
                        'user_id' => $user->id,
                        'business_account_id' => $businessAccount->id,
                        'review' => $faker->sentence(10),
                        'rating' => $faker->randomElement([1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5]),
                        'is_approved' => 1,
                        'is_edited' => 0,
                        'disputed' => 0,
                        'interaction_detail' => $faker->sentence(3),
                        'interaction_date' =>  now()
                    ]);
                }
            }
        
            // Update the statistics for the business account
            $account = BusinessAccount::find($businessAccount->id);
            $account->updateStats();
        }
        
       
    }
}
