<?php

namespace Database\Seeders;

use App\Models\User; // Import User model
use App\Models\Publication; // Import Publication model
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash if creating a specific user

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- User Seeding ---

        // Option 1: Create a specific known user (useful for testing login)
        User::factory()->createMany([
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'), // Or bcrypt('password')
            ],
            [
                'name' => 'Test User 2',
                'email' => 'test2@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Test User 3',
                'email' => 'test3@example.com',
                'password' => Hash::make('password'),
            ]
        ]);


        // --- Publication Seeding ---

        $numberOfPublications = 25; // How many publications to create
        $publications = Publication::factory($numberOfPublications)->create();

        // --- Attach Users to Publications (Many-to-Many) ---

        // Get all user IDs (including the specific test user if created)
        $allUserIds = User::pluck('id'); // More efficient than fetching full models

        // Loop through each publication and attach 1 to 3 random users
        foreach ($publications as $publication) {
            // Select 1 to 3 random user IDs from the collection of all user IDs
            $randomUserIds = $allUserIds->random(rand(1, 3))->toArray();

            // Attach the selected users to the current publication
            $publication->users()->attach($randomUserIds);
        }

        // You can still call other seeders if needed:
        // $this->call([
        //     AnotherSeeder::class,
        // ]);

        $this->command->info('Database seeded successfully!'); // Optional feedback
    }
}
