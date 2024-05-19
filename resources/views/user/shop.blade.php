@extends('layouts.user.app')
@section('title')
Shop
@endsection

@section('intro')
Welcome To Our <span clsas="d-block">Shopinng Store</span>
@endsection
@section('buttons')
<a href="{{route('blog')}}" class="btn btn-secondary me-2">Explore More</a>
@endsection
@section('content')
<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">

            @foreach ($products as $product)
            <div class="col-12 col-md-4 col-lg-3 mb-5">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <a class="product-item" href="#" onclick="this.closest('form').submit(); return false;">
                        <img src="{{ asset($product->picture_path) }}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <strong class="product-price">${{ number_format($product->price, 2) }}</strong>
                        <span class="icon-cross">
                            <img src="{{ asset('images/cross.svg') }}" class="img-fluid">
                        </span>
                    </a>
                </form>
            </div>
            @endforeach
            
  
        </div>
    </div>
</div>

@endsection