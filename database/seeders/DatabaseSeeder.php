<?php

namespace Database\Seeders;

use App\Models\{User, Role, Contact};
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Roles
        $this->call(RoleSeeder::class);

        $adminRole = Role::where('name', 'Admin')->first();
        $userRole  = Role::where('name', 'User')->first();

        //create an admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // change in real world
            'role_id' => $adminRole->id,
        ]);

        // Create a normal user
        $user = User::factory()->create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role_id' => $userRole->id,
        ]);

        
    // Create contacts for admin and user
    Contact::factory()->count(5)->create(['user_id' => $admin->id]);
    Contact::factory()->count(5)->create(['user_id' => $user->id]);
    }
}
