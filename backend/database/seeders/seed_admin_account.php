<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class seed_admin_account extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new \App\Models\User)->create([
            'name' => 'admin',
            'email' => '4hprotein@gmail.com',
            'password' => Hash::make('duyHungGavl123'),
            'phone' => '0333303802',
        ]);
    }
}
