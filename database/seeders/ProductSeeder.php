<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $categoryId = DB::table('categories')->where('name', 'first')->value('id');
        

        DB::table('products')->insert([
            'name' => 'Teléfono móvil',
            'description' => 'Teléfono móvil de última generación',
            'price' => 500,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $producId = DB::table('products')->where('name', 'Teléfono móvil')->value('id');
        
        DB::table('productcategory')->insert([
            'product_id'=> $producId,
            'category_id'=> $categoryId

        ]);

       
        DB::table('products')->insert([
            'name' => 'Camiseta',
            'description' => 'Camiseta de algodón de alta calidad',
            'price' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
