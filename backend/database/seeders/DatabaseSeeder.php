<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            brands_table_default_data::class,
            categories_table_default_data::class,
            seed_admin_account::class,
            RolesAndPermissionsSeeder::class,
            add_missing_categories::class
        ]);
    }
}
