<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);

        // Generate 100 users
        for ($i = 1; $i <= 100; $i++) {
            $name = fake()->name();
            $email = Str::slug($name) . $i . '@example.com';
            $username = Str::slug($name) . $i;

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make('password123'),
            ]);

            $user->assignRole('user');

            $this->command->line("User Created: {$username}");
        }

        // Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'username' => 'adminuser',
            'password' => Hash::make('Admin123'),
        ]);
        $admin->assignRole('admin');

        $this->command->info('Admin Created');
    }
}
