<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call([
            AccessibilityOptionSeeder::class,
            AwardSeeder::class,
            AwardOptionSeeder::class,
            CommunitySeeder::class,
            DietaryRestrictionSeeder::class,
            OrganizationSeeder::class,
            PecsfRegionSeeder::class,
            PesfCharitySeeder::class,
            VipCategorySeeder::class,

            AwardSelectionSeeder::class,
            RecipientSeeder::class,
            UsersSeeder::class

        ]);
    }
}
