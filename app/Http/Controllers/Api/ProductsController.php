<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Productcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ProductsController extends Controller
{
    public function showProducts()
    {
        $products = Product::all();
        return $products;
    }


    // Filter products for category
    public function productsCategory(Request $request)
    {

        
    $categoryId = $request->input('categoryId');

    $products = DB::table('productcategory')
    ->where('category_id', $categoryId)
    ->pluck('product_id'); 

    if ($products->isEmpty()) {
        return response()->json([]);
    }

    $prod = DB::table('products') 
                ->whereIn('id', $products)
                ->get();

    return response()->json($prod);

    }


}
