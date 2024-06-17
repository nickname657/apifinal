<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity', 1);
        $name = $request->input('name');
        $price = $request->input('price');

        $product = Product::find($productId);

        if (!$product) {
            return 'El producto no existe.';
        }

        if (!session()->has('cart')) {
            session()->put('cart', []);
        }

        $cart = session()->get('cart');

        if (array_key_exists($productId, $cart)) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
                'name' => $name,
                'price' => $price
            ];
        }

        session()->put('cart', $cart);

        return 'Producto añadido al carrito correctamente.';
    }

    public function updateitem(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity', 1);

        $product = Product::find($productId);

        if (!$product) {
            return 'El producto no existe.';
        }

        if (!session()->has('cart')) {
            session()->put('cart', []);
        }

        $cart = session()->get('cart');

        if (array_key_exists($productId, $cart)) {
            $cart[$productId] = $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);

        return 'Producto añadido al carrito correctamente.';
    }


    public function getCart()
    {
        if (session()->has('cart')) {
            $a = session('cart');
            return $a;
        } else {
            return 'error in getcart';
        }
    }

    public function deleteitem(Request $request)
    {
        $productId = $request->input('productId');

        if (!session()->has('cart')) {
            return 'No hay productos en el carrito.';
        }

        $cart = session()->get('cart');


        if (array_key_exists($productId, $cart)) {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);

        return 'Producto eliminado del carrito correctamente.';
    }

    public function calculateTotalAmount()
    {
        $cart = session()->get('cart');
        $totalAmount = 0;

        foreach ($cart as $productId => $item) {
            $quantity = $item['quantity'];
            $product = Product::find($productId);
            $totalAmount += $product->price * $quantity;
        }

        return $totalAmount;
    }
}
