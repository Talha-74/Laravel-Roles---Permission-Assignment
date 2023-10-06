<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shopRole = Role::create(['name' => 'Shop']);

        $serviceProviderRole = Role::create(['name' => 'Service Provider']);

        $customerRole = Role::create(['name' => 'Customer', 'guard_name' => 'web']);
    }
}
