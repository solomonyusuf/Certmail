<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'image' => 'https://nira.org.ng/wp-content/uploads/2022/03/File_000new-2-scaled.jpeg',
            'name'=> 'Tech Support',
            'email'=> 'Tech_support@nira.org.ng',
            'password'=> bcrypt('Tech_support12!'),
        ]);
    }
}
