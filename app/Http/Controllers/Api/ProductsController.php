<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Productcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function addprod(Request $request){


        $product = new Product();
        $product->id = $request->idp;
        $product->name  = $request->totalamount;
        $product->description = $request->status;
        $product->price = $request->status;
        $product-> save();


        return response()->json([
            'message' => 'Product created successfully',
            'order' => $product,
        ]);

    }


    public function updateproduct(Request $request){
            $productId = $request->input('productId'); 
        
            $name = $request->input('name');
            $description = $request->input('description');
            $price = $request->input('price');


            $options = [ $name, $description, $price];
            $atributes =['name','description','price'];

            $product = DB::update('update products set ? = ? where id = ?', [$atributes,$options,$productId]);

        
        
         return response()->json([
                'message' => 'Product updated successfully',
                'product' => $product,
            ]);;
        
        
    }


    public function deleteProduct(Request $request)
    {

        $productid = $request->productid;


        $delet = DB::delete('delete products WHERE  id = ?', [$productid]);


        return response()->json([
            'message' => 'Product deleted successfully',
            'product' => $delet,
        ]);;
    }


}
