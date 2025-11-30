<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Seed SuperAdmin (no company)
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'SuperAdmin',
            'company_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Get Company ID from first company
        $company = DB::table('companies')->first();
        $companyId = $company->id;

        // Seed Admin
        DB::table('users')->insert([
            'name' => 'Client Admin',
            'email' => 'clientadmin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
            'company_id' => $companyId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Member
        DB::table('users')->insert([
            'name' => 'Client Member',
            'email' => 'member@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Member',
            'company_id' => $companyId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
