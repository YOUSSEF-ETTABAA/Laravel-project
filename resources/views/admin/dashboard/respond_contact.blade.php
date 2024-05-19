
@extends('layouts.admin.app')

@section('content')
<style>
    .card-custom {
    border: none;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.card-title-custom {
    margin-bottom: 0;
}

.card-body-custom {
    padding: 2rem;
}

.form-label-custom {
    font-weight: bold;
}

.form-control-custom[readonly] {
    background-color: #f8f9fa;
    cursor: not-allowed;
}

.btn-wrapper-custom {
    display: flex;
    justify-content: center;
}

.btn-back-custom {
    margin-right: 10px;
}

.btn-primary-custom {
    width: 150px;
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

.btn-primary-custom:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    color: white;
}
.btn-back-custom{
  width: 150px; 
  background-color: gray;
  margin-left: 5px;
  border-color: gray;
}
.btn-back-custom:hover{
  background-color: gray;
  color: white;
  border-color: gray;
}

.admin-response-custom {
    margin-top: 20px;
}
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h1 class="mt-5">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Contacts</li>
            </ol>
            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Orders</div>
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
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">product management</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
<div class="container mt-5 px-5" >
    <div class="row">
        <div class="col-9" >
                <div class="row mb-5 gx-5 ">
                    <div class="col-xxl-8 mb-5 mb-xxl-0">
                        <div class="card card-custom">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title card-title-custom ">Contact Details</h5>
                            </div>
                            <div class="card-body card-body-custom">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label form-label-custom">First Name *</label>
                                        <input type="text" class="form-control form-control-custom" placeholder="" aria-label="First name" value="{{ $contact->firstName }}" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label form-label-custom">Last Name *</label>
                                        <input type="text" class="form-control form-control-custom" placeholder="" aria-label="Last name" value="{{ $contact->lastName }}" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label form-label-custom">Email *</label>
                                        <input type="email" class="form-control form-control-custom" id="inputEmail4" value="{{ $contact->email }}" readonly>
                                    </div>

                                    <div class="col-md-6">
                                      <label class="form-label form-label-custom">Date *</label>
                                      <input type="text" class="form-control form-control-custom" value="{{ $contact->created_at }}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label form-label-custom">Message *</label>
                                        <textarea class="form-control form-control-custom" rows="5" readonly>{{ $contact->message }}</textarea>
                                    </div>
                                    <form method="POST" action="{{ route('send-mail', ['id' => $contact->id]) }}">
                                        @csrf
   
                                    <div class="col-12 admin-response-custom">
                                        <label class="form-label form-label-custom">Admin Response</label>
                                        <textarea class="form-control form-control-custom" rows="5" name="response"></textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="card-footer bg-light">
                                <div class="btn-wrapper-custom">
                                    <button class="btn btn-primary-custom" type="submit">Submit</button>
                                    <button class="btn btn-back-custom btn-secondary">
                                        <a href="{{route('contacts.index')}}" style="text-decoration: none; color:white">Back</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </form> 
        </div>
    </div>
</div>

@endsection