<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheeckoutController extends Controller
{
    public function index(){
        $products =  CartItem::where('user_id', Auth::id())->with('product')->get();
        $totalAmount = 0;
        foreach ($products as $product) {
            $subtotal = $product->product->price * $product->quantity;
            $totalAmount += $subtotal;
        }
        $order_items = ['products'=> $products,'totalAmount'=>$totalAmount];
        return view('user.cheeckout',compact('order_items'));
    }

    public function store(Request $request) {

        $request->validate([ 
            'c_address' => 'required|string|max:255',
        ]);

        $products =  CartItem::where('user_id', Auth::id())->with('product')->get();

        $totalAmount = 0;
        foreach ($products as $product) {
            $subtotal = $product->product->price * $product->quantity;
            $totalAmount += $subtotal;
        }
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->total_amount = $totalAmount;
        $order->address = $request->input('c_address');
        $order->custom_address = $request->input('custom_address');
        $order->save();


        foreach ($products as $product) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product['product_id'];
            $orderItem->quantity = $product->quantity;
            $orderItem->price = $product->product->price * $product->quantity;
            $orderItem->save();
        }

        CartItem::where('user_id', Auth::id())->delete();
        return redirect()->route('thankyou');
    }

}
