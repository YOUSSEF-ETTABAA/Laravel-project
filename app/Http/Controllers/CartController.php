<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $products =  CartItem::where('user_id', Auth::id())->with('product')->get();
        return view('user.Cart',compact('products'));
    }
    public function addToCart(Request $request)
    {

        $product = Product::find($request->product_id);
    
        if ($product) {
            $cartItem = new CartItem();
            $cartItem->product_id = $product->id;
            $cartItem->user_id = Auth::user()->id;

            $cartItem->save();
    
            return redirect()->route('cart')->with('success', 'Product added to cart successfully.');
        }
    
        return redirect()->back()->with('error', 'Product not found.');
    }

    public function updateCart(Request $request)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        foreach ($cartItems as $cartItem) {

            $cartItem->quantity = $request->input('quantity_' . $cartItem->id);
            $cartItem->save();
        }
        return redirect()->route('cheeckout.index');
    }
 
    public function destroy($id){
        CartItem::destroy($id);
        return redirect()->route('cart');
    }
}
