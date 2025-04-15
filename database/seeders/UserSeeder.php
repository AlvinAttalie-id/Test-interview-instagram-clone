<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat role jika belum ada
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);

        // Daftar nama yang ingin dibuat
        $userNames = [
            'Katsura',
            'Wednesday',
            'TungTungTug',
            'Mikasa',
            'Tanjiro',
            'Violet',
            'Gojo',
            'Luffy',
            'Levi',
            'Killua',
        ];

        foreach ($userNames as $name) {
            $email = strtolower($name) . '@example.com';
            $username = strtolower($name);
            $password = $name . '123'; // Password berdasarkan nama

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($password),
            ]);

            $user->assignRole('user');

            // Tampilkan informasi user di terminal
            $this->command->line("Name     : {$user->name}");
            $this->command->line("Email    : {$user->email}");
            $this->command->line("Username : {$user->username}");
            $this->command->line("Role     : user");
            $this->command->line("Password : {$password}");
            $this->command->line(str_repeat('-', 40));
        }

        // Buat admin juga
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'username' => 'adminuser',
            'password' => Hash::make('Admin123'),
        ]);
        $admin->assignRole('admin');

        $this->command->info("Admin:");
        $this->command->line("Name     : {$admin->name}");
        $this->command->line("Email    : {$admin->email}");
        $this->command->line("Username : {$admin->username}");
        $this->command->line("Role     : admin");
        $this->command->line("Password : Admin123");
    }
}
