<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('active', false)
                       ->with('items.product.category')
                       ->paginate(6);
    
        return view('admin.dashboard.orders', compact('orders'));
    }

    public function getOrderDetails($id)
    {
        $order = Order::with('items.product.category')->find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        $orderItems = $order->items->map(function ($item) {
            $item->product->picture_path = asset($item->product->picture_path);
            return $item;
        });
    
        return response()->json([
            'items' => $orderItems,
            'total_amount' => $order->total_amount,
        ]);
    }

    public function activeOrder(Request $request,$id){

        $order = Order::find($id);
        if ($order->order_status && $order->pay_status) {
            $order->active = true;
            $order->save();
            return redirect()->route('orders.index')->with('success', 'Order activated successfully.');
        }
       
    }
    public function activeOrders(){

        $orders = Order::where('active', true)
        ->with('items.product.category')
        ->paginate(6);

        return view('admin.dashboard.activeOrders', compact('orders'));
    }
    
    public function search(Request $request){

        $search = $request->input('search');
        $orders = Order::where('id',$search )
                    ->orWhereHas('user', function($query) use ($search) {
                        $query->where('full_name', 'like', '%' . $search . '%')
                              ->orWhere('phone_number', $search );
                    })
                    ->paginate(6);

        return view('admin.dashboard.orders', compact('orders'));
    }
    public function changeOrderStatus($id){

        $order = Order::find($id);
        $order->order_status = !$order->order_status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    public function changePayStatus($id){

        $order = Order::find($id);
        $order->pay_status = !$order->pay_status;
        $order->save();

        return redirect()->back()->with('success', 'Payment status updated successfully');
    }
}
