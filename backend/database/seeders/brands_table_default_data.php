<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class brands_table_default_data extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand_data = [
            'ALLMAX', 'ANS PERFORMANCE', 'AOLIKES', 'APPLIED NUTRITION',
            'AST SPORT', "BEST'S DOCTOR", 'BFF',   'BIOTECH USA',
            'BLADE', 'BPI SPORTS', 'BRONSON', 'BULK POWDER',
            'CALIFORNIA ALMONDS', 'CELLUCOR',   'CENTRUM', 'CRISCO',
            'DEAL SUPPLEMENT', 'DYMATIZE', 'ELITE LAB USA',
            'EMERGEN C', 'ENZYMATIC THERAPY',    'ERGO NUTRITION',
            'EVL NUTRITION', 'EVOLITE NUTRITION', 'FA Engineered Nutrition',
            'FIT CUSINE',   'GASPARI NUTRITION', 'GOLI NUTRITION', 'GOOD GATHER',
            'GREAT VALUE', 'INNER ARMOUR', 'JNX SPORTS',   'KEVIN LEVRONE', 'KFD NUTRITION',
            'KIRKLAND', 'LABRADA NUTRITION', 'LAKE AVENUE', 'MICRO INGREDIENTS',
            'MUSCLESPORTS', 'MUSCLETECH', 'MUTANT', 'MYPROTEIN', 'MYVEGAN',
            'MYVITAMINS BEAUTY', 'N1PROTEIN',  'NATURE BOUNTY', 'NATURE MADE',
            'NATURE REWARD', "NATURE'S BOUNTY", "NATURE'S WAY", 'NOW FOODS',
            'NUTRABOLICS', 'NUTREX', 'NUTRICOST', 'NUU NUTRITION', 'ONE A DAY',
            'OPTIMUM NUTRITION', 'OSTROVIT',   'OUTBREAK', 'PAM', 'PLAY NUTRITION',
            'PROSUPP', 'PVL NUTRITION', "Puritan's Pride", 'QUAKER',  'RAW NUTRITION',
            'REDCON1', 'REDCORE', 'REPP Sports', 'RIVAL NUTRITION', 'RONNIE COLEMAN',
            'RSP NUTRITION', 'RULE1 PROTEIN', 'SCHIFF', 'SCITEC NUTRITION', 'SCIVATION',
            'SOWELO',   'SUNDOWN NATURAL', 'SWANSON', 'TREC NUTRITION', 'USN',
            'Ultimate Nutrition', 'VITAFUSION',    'VITAXTRONG', 'W-POWER',
            'WARRIOR NUTRITION', 'XTEND', 'YOUTHEORY', 'ZNutrition'
        ];
        foreach ($brand_data as $brand) {
            (new \App\Models\Brand())->create([
                'brand_name' => $brand,
            ]);
        }
    }
}
