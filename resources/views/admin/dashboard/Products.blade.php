@extends('layouts.admin.app')

@section('content')
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
                            <a class="small text-white stretched-link" href="{{route('contacts.index')}}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Orders</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{route('orders.index')}}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Active Orders</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{route('orders.active.index')}}">View Details</a>
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

        @if ($products->isEmpty())
        <h1 style="text-align: center;">There are no products available.</h1>
        @else

        <div class="container mt-5">
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <div class="">
                        <h5 class="card-title">Product List <span class="text-muted fw-normal ms-2">({{$products->count()}})</span></h5>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-plus"></i> Add New Product
                    </button>
                </div>
            </div>

            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding new product -->
                            <form action="{{route('admin-create')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="productName" class="form-label custom-label" style="color: #ff6600;">Product Name *</label>
                                    <input type="text" class="form-control" id="productName" name="product_name" placeholder="Enter product name">
                                    @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="productDescription" class="form-label custom-label" style="color: #ff6600;">Product Description *</label>
                                    <textarea class="form-control" id="productDescription" rows="3" name="product_description" placeholder="Enter product description"></textarea>
                                    @error('product_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="productPrice" class="form-label custom-label" style="color: #ff6600;">Product Price *</label>
                                    <input type="number" class="form-control" id="productPrice" name="product_price" placeholder="Enter product price">
                                    @error('product_price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="productCategory" class="form-label custom-label" style="color: #ff6600;">Product Category *</label>
                                    <select class="form-select" id="productCategory" name="product_category" required>
                                        <option selected disabled>Select a category</option>
                                        @foreach ($categories as $category)
                                        <option>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="productPrice" class="form-label custom-label" style="color: #ff6600;">Product stock *</label>
                                    <input type="number" class="form-control" id="" name="product_stock" placeholder="Enter product price">
                                    @error('product_stock')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 file-input">
                                    <label for="productPicture" class="form-label custom-label" style="color: #ff6600;">Product Picture *</label>
                                    <input type="file" class="form-control" name="product_picture" id="productPicture">
                                    @error('product_picture')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Add more form fields as needed -->
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap align-middle table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Category</th>
                                        <th scope="col" style="width: 200px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{asset($product->picture_path)}}" alt="" class="avatar-sm rounded-circle me-2" /><a href="#" class="text-body">{{ $product->name }}</a>
                                        </td>
                                        <td>
 
                                            @if (strlen($product->description) > 50)
                                            <div>{{ substr($product->description, 0, 50) }}...</div>
                                            <button type="button" class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#messageModal{{ $product->id }}">View Message</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="messageModal{{ $product->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $product->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="messageModalLabel{{ $product->id }}">Message Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                                            {{ $product->description }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div>{{ $product->description }}</div>
                                        @endif
                                        </td>

                                        <td>
                                            <div>{{ $product->price }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $product->category->name }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{route('update.product.form',['id' => $product->id])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-sm btn-primary me-2"><i class="bx bx-pencil"></i></a>
                                                <a href="{{route('admin.remove.product',$product)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-sm btn-danger"><i class="bx bx-trash-alt"></i></a>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-0 align-items-center pb-4">
                <div class="col-sm-6">
                    <div class="float-sm-end">
                        <ul class="pagination mb-sm-0">
                            <div class="d-flex justify-content-center"> 
                                {{ $products->links() }}
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
@endsection
<!-- Modal -->

