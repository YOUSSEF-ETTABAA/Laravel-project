
@extends('layouts.admin.app')

@section('content')
<style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }
        label {
            font-weight: bold;
        }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-5">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Contacts</li>
            </ol>
            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Contacts</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body"> Orders</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Active Orders</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <div class="container mt-4 ">
        @if (Session::has('success'))
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
            </div>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-danger text-center">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        <div class="container">
            <div class="card p-4">
                <div class=" py-3 rounded mb-4">
                    <h2 class="text-primary text-center">Update Product</h2>
                </div>
                <form action="{{route('update.product.sumbit' ,['id'=>$product->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Product Name:</label>
                            <input type="text" class="form-control" id="productName" name="productName" value="{{ $product->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="productPrice" class="form-label">Product Price:</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" min="0" step="0.01" value="{{ $product->price }}" required>
                        </div>
                        <div class="col-12">
                            <label for="productDescription" class="form-label">Product Description:</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" rows="4" required>{{ $product->description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="productStock" class="form-label">Product Stock:</label>
                            <input type="number" class="form-control" id="productStock" name="productStock" min="0" value="{{ $product->stock_quantity }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="productCategory" class="form-label">Product Category:</label>
                            <select class="form-select" name="productCategory" id="productCategory"  required>
                                @foreach ($categories as $category)
                                    <option {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="col-md-6">
                                <label for="productPicture" class="form-label">Product Picture:</label>
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    <img src="{{ asset($product->picture_path) }}" alt="Product Picture" class="img-thumbnail mb-2">
                                    <input type="file" class="form-control" id="productPicture" name="productPicture">
                                </div>
                            </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary w-100">Update Product</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('products.index')}}" class="btn btn-secondary w-100">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        
        
        

</div>
@endsection