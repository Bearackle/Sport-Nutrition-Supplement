<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class categories_table_default_data extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parent_categories = ['Whey Protein','Mass Gainer','BCAA-EAA','Fat Burner','Preworkout','Vitamin','Đơn Chất','Thực Phẩm Sức Khỏe Ăn Kiêng','Phụ Kiện','Thanh Lý Sản Phẩm Lỗi'];
        $children_categories = [1 => ['Protein Trả  i Dài','Protein Thực Vật'],
                                2 => ['Mass Cao Năng Lượng','Mass Trung Năng Lượng'],
                                3 => ['EAA','BCAA'],
                                4 => ['Đốt Mỡ Không Chất Kích Thích', 'Đốt Mỡ Có Chất Kích Thích'],
                                5 => ['Tăng Sức Mạnh Có Caffeine','Tăng Sức Mạnh Không Caffeine'],
                                6 => ['Vitamin Sức Khỏe','Thực phẩm Sắc Đẹp','ZMA (Zinc - Magnesium - B6)'],
                                7 => ['Creatine','Caffeine','Beta Alanine','Citrulline','Arginine','Taurine','Các Đơn Chất Khác'],];
        foreach($parent_categories as $category){
            (new \App\Models\Category)->create([
                'CategoryName' => $category,
            ]);
        }
        foreach($children_categories as $index => $p_category){
            foreach($p_category  as $c_category) {
                (new \App\Models\Category)->create([
                    'CategoryName' => $c_category,
                    'ParentID' => $index
                ]);
            }
        }
    }
}
