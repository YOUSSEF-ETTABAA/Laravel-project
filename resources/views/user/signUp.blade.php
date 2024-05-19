@extends('layouts.user.app2')
@section('title')
Sign Up
@endsection


@section('content')
<style>
    html {
        height: 100%;
    }

    body {
        margin:0;
        padding:0;
        font-family: sans-serif;
        background: #3b5d50;
    }

    .container-background {
        width: 500px;    
        background: rgba(0,0,0,.5);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0,0,0,.6);
        border-radius: 10px;     
    }

    h4,p {
        color: #fff;
    }

</style>
<div class="container-fluid h-100 d-flex justify-content-center align-items-center">
    <div class="container-background mt-5"> 
        <div class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-4 mb-3 text-center">Create Account</h4>
            <!-- Success message -->
            @if(session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <p class="text-center mb-4">Get started with your free account</p>
            <div class="icons mb-3 text-center">
                <i class="fab fa-google"></i>
                <i class="fab fa-twitter" style="color:  #1DA1F2;"></i>
                <i class="fab fa-facebook"></i>
            </div>
            <p class="divider-text mb-4">
                <span style="background-color: #ff7200">OR</span>
            </p>
            <form action="{{route('signUp.sumbit')}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <input name="full_name" class="form-control" placeholder="Full name" type="text">
                    @error('full_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> 
                <div class="form-group mb-3">
                    <input name="email" class="form-control" placeholder="Email address" type="email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> 
                <div class="form-group mb-3">
                    <div class="input-group">
                        <input name="phone_number" class="form-control" placeholder="Phone number" type="text" >
                    </div>
                    @error('phone_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <select name="city" class="form-select" style="height: 50px">
                        <option value="" selected disabled>Select Your City</option>
                        <option value="Rabat">Rabat</option>
                        <option value="Casablanca">Casablanca</option>
                        <option value="Fes">Fes</option>
                        <option value="Tangier">Tangier</option>
                        <option value="Agadir">Agadir</option>
                        <option value="Marrakech">Marrakech</option>
                        <option value="Meknes">Meknes</option>
                        <option value="Oujda">Oujda</option>
                        <option value="Kenitra">Kenitra</option>
                        <option value="El Jadida">El Jadida</option>
                    </select>
                    @error('city')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> 
                <div class="form-group mb-3">
                    <input name="password" class="form-control" placeholder="Create password" type="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> 
                <div class="form-group mb-3">
                    <input name="password_confirmation" class="form-control" placeholder="Repeat password" type="password">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>                                     
                <div class="form-group mb-4">
                    <center>
                        <button type="submit" class="btn btn-block" style="background: #ff7200;">Create Account</button>
                    </center>
                </div>      
                <p class="text-center mb-3">Have an account? <a href="{{route('login')}}" style="color: #ff7200">Log In</a></p>                                                                 
            </form>
        </div>
    </div>
</div>

@endsection
