<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'description' => 'Full control over the entire system.',
            ],
            [
                'name' => 'admin',
                'description' => 'Can manage most aspects of the system.',
            ],
            [
                'name' => 'product_manager',
                'description' => 'Manages projects, tasks, and time logs.',
            ],
            [
                'name' => 'client',
                'description' => 'Can view their own projects and invoices.',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
