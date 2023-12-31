<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Talha',
            'email' => 'talhashinwari7474@gmail.com',
            'password' => Hash::make('1234'),
        ]);
        $user = User::find(1);
        $user->assignRole('Shop');
    }
}
