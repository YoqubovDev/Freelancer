<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('1234'),
            ]
        );

        // Admin rolini biriktiramiz
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $user->roles()->syncWithoutDetaching([$adminRole->id]);
        }
    }
}
