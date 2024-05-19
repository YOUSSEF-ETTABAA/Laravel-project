@extends('layouts.user.app')
@section('title', 'Cart')
@section('intro', 'Cart')
@section('buttons')
    @if(auth()->check())
        @if($products->isNotEmpty())
            <a href="{{route('shop')}}" class="btn btn-secondary me-2">Shop Now</a>
            <a href="#" class="btn btn-white-outline">Explore</a>
        @endif
    @endif
@endsection

@section('content')
<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            @if(auth()->check())
                <form id="checkout-form" method="post" action="{{ route('cart.update') }}">
                    @csrf
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr class="product-row">
                                    <td class="product-thumbnail">
                                        <img src="{{ asset($product->product->picture_path) }}" alt="Product Image" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $product->product->name }}</h2>
                                    </td>
                                    <td class="product-price">${{ number_format($product->product->price, 2) }}</td>
                                    <td>
                                        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;margin-left:22%">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                                            </div>
                                            <input type="text" class="form-control text-center quantity-amount" name="quantity_{{$product->id}}" value="{{ $product->quantity }}" placeholder="" aria-label="Quantity" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-black increase" type="button">&plus;</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-total">${{ number_format($product->product->price * $product->quantity, 2) }}</td>
                                    <td>
                                        <a href="{{ route('cart.remove', ['id' => $product->id]) }}" class="btn btn-black btn-sm" style="font-size:30px">x</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Your cart is empty. <a href="{{ route('shop') }}">Start shopping now!</a></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
               
            @else
            <div class="col-md-12 text-center" >
                <div class="row" style="margin-left:28%">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p>Please <a href="{{ route('login') }}">login</a> to view your cart.</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @if(auth()->check() && $products->isNotEmpty())
        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button class="btn btn-black btn-sm btn-block">
                            <a href="{{route('shop')}}" style="text-decoration: none;color:white;font-size:15px">Continue Shopping</a>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="text-black h4" for="coupon">Coupon</label>
                        <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                        <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-black">Apply Coupon</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black" name>Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black subtotal"></strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black total"></strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Proceed To Checkout</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
