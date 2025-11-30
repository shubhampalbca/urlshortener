<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // Create a sample company
        DB::table('companies')->insert([
            'name' => 'Acme Corp',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // No return statement!
    }
}
