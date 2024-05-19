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
    
        @if ($contacts->isEmpty())
            <h1 style="text-align: center;">There are no contacts available.</h1>
        @else
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h5 class="card-title">Contact List <span class="text-muted fw-normal ms-2">({{$contacts->total()}})</span></h5>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap align-middle table-borderless">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Message</th>
                                        <th scope="col" style="width: 200px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                    <tr>
                                        <td>
                                            <span href="#" class="text-body">{{ $contact->firstName  }}</span>
                                        </td>
                                        <td>
                                            <span href="#" class="text-body">{{ $contact->lastName }}</span>
                                        </td>
                                        
                                        <td>
                                            <span class="badge badge-soft-success mb-0">{{ $contact->email }}</span>
                                        </td>
                                        <td>
                                            @if (strlen($contact->message) > 50)
                                            <div>{{ substr($contact->message, 0, 50) }}...</div>
                                            <button type="button" class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">View Message</button>
                                            @else
                                            <div>{{ $contact->message }}</div>
                                            @endif

<!-- Modal -->
<div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $contact->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel{{ $contact->id }}">Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 300px; overflow-y: auto;">
                {{ $contact->message }}
            </div>
        </div>
    </div>
</div>

                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{route('admin.respond',['id' => $contact->id])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-sm btn-primary me-2"><i class="bx bx-pencil"></i></a>
                                                <a href="{{route('admin.remove.contact',$contact)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-sm btn-danger"><i class="bx bx-trash-alt"></i></a>
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
                                {{ $contacts->links() }}
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
@endsection

