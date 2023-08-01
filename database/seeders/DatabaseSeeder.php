<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $seeders = [
            RolesAndPermissionsSeeder::class, // roles and permissions
            // HashtagSeeder::class, // create hastags (combos)
            // CategoriesSeeder::class, // categories
            AdminSeeder::class, // super_admin
            // UsersSeeder::class, // users from factory
            // NewsSeeder::class, // news from factory
            // ProductsSeeder::class, // Products from factory
            // AdvertisementSeeder::class, // Advertisements from factory
            // SocialsSeeder::class, // Socials from factory

        ];
        /** Loop Through */
        foreach($seeders as $seed){
            $this->call($seed);
        }

    }
}
