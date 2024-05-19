@extends('layouts.user.app')
@section('title')
cheekout
@endsection
@section('intro')
cheekout
@endsection
@section('buttons')
<a href="{{route('shop')}}" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a>
@endsection

@section('content')
<div class="untree_co-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black" style="text-align: center">Your Order</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <table class="table site-block-order-table mb-5">
                                <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    @foreach ($order_items['products']  as $product)
                                    <tr>
                                        <td>{{$product->product->name}}</td>
                                        <td>{{$product->quantity * $product->product->price}}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                        <td class="text-black ">${{$order_items['totalAmount']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                        <td class="text-black font-weight-bold "><strong>${{$order_items['totalAmount'] * (1 + 0.05)}}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
        <form action="{{route('cheeckout.store')}}" method="POST">
            @csrf
            <div class="mb-4" style="margin-top: 30px">
              <div class="form-group row mt-3">
                  <div class="col-md-12">
                    
                      <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address" required>
                    
                  </div>
              </div>

              <div class="form-group mt-3">
                  <input type="text" class="form-control" name="custom_address" placeholder="Apartment, suite, unit etc. (optional)">
              </div>
          </div>
                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                                <div class="collapse" id="collapsebank">
                                    <div class="py-2">
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                                <div class="collapse" id="collapsecheque">
                                    <div class="py-2">
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border p-3 mb-5">
                                <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                                <div class="collapse" id="collapsepaypal">
                                    <div class="py-2">
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <button class="btn btn-black btn-lg py-3 btn-block" type="submit">Place Order</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <form>  
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
