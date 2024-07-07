<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'view_dashboard'],
            ['name' => 'manage_rekanan'],
            ['name' => 'manage_admin'],
            ['name' => 'manage_finance'],
            ['name' => 'manage_operasional'],
            ['name' => 'manage_marketing'],
            ['name' => 'manage_human_resource'],
            // Add more permissions as needed
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
