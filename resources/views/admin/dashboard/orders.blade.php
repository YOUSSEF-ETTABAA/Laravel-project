@extends('layouts.admin.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-5">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Orders</li>
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
                        <div class="card-body">Active Orders</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{route('orders.active.index')}}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">product management</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{route('products.index')}}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
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

        @if ($orders->isEmpty())
        <h1 class="text-center mt-5">There are no orders available.</h1>
        @else
        <div class="container mt-5">
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <div class="">
                        <h5 class="card-title d-inline">Order List <span class="text-muted fw-normal ms-2">({{$orders->count()}})</span></h5>
                    </div>
                </div>
                <div class="col-md-5 d-flex justify-content-end" style="margin-left: 6%">
                    <form action="{{ route('searchOrders') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search orders...">
                            <button type="submit" class="btn btn-outline-primary bg-primary text-white">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap align-middle table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Contact</th>
                                        <th>Order Date</th>
                                        <th>Address</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                        <th>More Details</th>
                                        <th>Activate</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->full_name }}</td>
                                            <td>{{ $order->user->phone_number }}</td>
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>
                                                @if($order->order_status == 0)
                                                    <a href="{{ route('changeOrderStatus', ['id' => $order->id])}}">
                                                        <button class="btn btn-danger" style="margin-left: 7px">Pending</button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('changeOrderStatus', ['id' => $order->id])}}">
                                                        <button class="btn btn-success" style="margin-left: 4px">Delivered</button>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->pay_status == 0)
                                                    <a href="{{ route('changePayStatus', ['id' => $order->id])}}">
                                                        <button class="btn btn-danger" style="margin-left: 20px">Unpaid</button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('changePayStatus', ['id' => $order->id])}}">
                                                        <button class="btn btn-success" style="margin-left: 30px">Paid</button>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <a href="#" class="btn btn-secondary view-order mx-3" data-bs-toggle="modal" data-bs-target="#orderModal" data-order-id="{{ $order->id }}">View</a>
                                            </td>
                                            <td>
                                                @if($order->order_status && $order->pay_status)
                                                    <form action="{{route('active-order',['id'=>$order->id])}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary" style="margin-right:9px ">Activate</button>
                                                    </form>
                                                @else
                                                <button type="button" class="btn btn-primary" style="margin-right:9px" data-bs-toggle="modal" data-bs-target="#messageModal{{ $order->id }}">Activate</button>
                                                <!-- Modal -->
                                            <div class="modal fade" id="messageModal{{ $order->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $order->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-danger" id="messageModalLabel{{ $order->id }}">Error </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Order status and pay status must be true to activate the order.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                @endif
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
                                {{ $orders->links() }}
                            </div>
                        </ul>
                    </div>
                </div>
            </div>


        <!-- Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mb-4">
                        <h5>Order Items</h5>
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap align-middle table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="orderItems">
                                </tbody>
                            </table>
                            <p><strong class="text-primary">Total Amount:</strong> <strong id="totalAmount"></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

</div>


@endsection
