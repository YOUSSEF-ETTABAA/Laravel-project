@extends('layouts.user.app2')
@section('title')
Edit Profile
@endsection

@section('content')
<style>
    body {
        margin:0;
        padding:0;
        font-family: sans-serif;
        background: #3b5d50;
    }

    .container-background {
        background: rgba(0, 0, 0, 0.5);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
        max-width: 500px; 
        max-height: 880px;
        
    }

    .card-title {
        color: white;
        padding-bottom: 20px
    }

    .form-control {
        border-color: #ced4da;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: none;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Colored labels */
    .form-label {
        color: #ffc800;
    }

    /* Centered submit button */
    .btn-block {
        margin: 0 auto;
        display: block;
        margin-top: 20px;
    }

    /* Error message style */
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    /* Success message style */
    .success-message {
        color: green;
        font-size: 14px;
        margin-bottom: 20px;
    }
</style>

<div class="container-fluid h-100 d-flex justify-content-center align-items-center" >
    <div class="container-background mt-5 p-4 rounded">
        <div class="card-body mx-auto" style="width: 400px;">
            <h4 class="card-title mt-4 mb-3 text-center">Edit Profile</h4>

            @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name :</label>
                    <input id="full_name" name="full_name" class="form-control" value="{{ Auth::user()->full_name }}" required>
                    <span class="error-message">{{ $errors->first('full_name') }}</span>
                </div> 
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address :</label>
                    <input id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>

                    <span class="error-message">{{ $errors->first('email') }}</span>
                </div> 
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number :</label>
                    <input id="phone_number" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}" required>

                    <span class="error-message">{{ $errors->first('phone_number') }}</span>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City : </label>
                    <select id="city" name="city" class="form-select" required>
                        <option value="" disabled>Select Your City</option>
                        <option value="Rabat" {{ Auth::user()->city == 'Rabat' ? 'selected' : '' }}>Rabat</option>
                        <option value="Casablanca" {{ Auth::user()->city == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
                        <option value="Fes" {{ Auth::user()->city == 'Fes' ? 'selected' : '' }}>Fes</option>
                        <option value="Tangier" {{ Auth::user()->city == 'Tangier' ? 'selected' : '' }}>Tangier</option>
                        <option value="Agadir" {{ Auth::user()->city == 'Agadir' ? 'selected' : '' }}>Agadir</option>
                        <option value="Marrakech" {{ Auth::user()->city == 'Marrakech' ? 'selected' : '' }}>Marrakech</option>
                        <option value="Meknes" {{ Auth::user()->city == 'Meknes' ? 'selected' : '' }}>Meknes</option>
                        <option value="Oujda" {{ Auth::user()->city == 'Oujda' ? 'selected' : '' }}>Oujda</option>
                        <option value="Kenitra" {{ Auth::user()->city == 'Kenitra' ? 'selected' : '' }}>Kenitra</option>
                        <option value="El Jadida" {{ Auth::user()->city == 'El Jadida' ? 'selected' : '' }}>El Jadida</option>
                    </select>

                    <span class="error-message">{{ $errors->first('city') }}</span>
                </div> 
                
                <div class="mb-3">
                    <label for="password" class="form-label">New Password :</label>
                    <input id="password" name="password" class="form-control" type="password" placeholder="Leave blank to keep the same">

                    <span class="error-message">{{ $errors->first('password') }}</span>
                </div> 
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password :</label>
                    <input id="password_confirmation" name="password_confirmation" class="form-control" type="password" placeholder="Leave blank to keep the same">

                    <span class="error-message">{{ $errors->first('password_confirmation') }}</span>
                </div>                                     
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </div>      
            </form>
        </div>
    </div>
</div>
@endsection
