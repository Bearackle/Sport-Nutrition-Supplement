<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class add_missing_categories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new \App\Models\Category)->create([
            'category_name' => 'GIÁ SIÊU ƯU ĐÃI'
        ]);
        (new \App\Models\Category)->create([
            'category_name' => 'Deal Hot - Combo Tiết Kiệm'
        ]);
    }
}
