@extends('layouts.user.app2')
@section('title')
    Profile
@endsection

@section('content')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: #3b5d50;
        }

    </style>
    <div class="wrapper">
      <div class="left">
        @if(Auth::user()->profile_picture)
            <img src="{{ asset(Auth::user()->profile_picture) }}" alt="user" class="img-thumbnail" width="200" />
        @else
            <img src="{{ asset('images/user.png') }}" alt="user" class="img-thumbnail" width="200" />
        @endif
        <div>
            <div class="file-input">
                <form action="{{ route('profile.update.picture') }}" method="post" id="profile-picture-form" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="file" name="profile_picture" class="file">
                    <label for="file">Select picture</label>
                </form>
            </div>
        </div>
    </div>
    
        <div class="right">
            <div class="info">
                <h3>Customer Information</h3>
                <div class="info_data">
                    <div class="data">
                        <h4>Full name:</h4>
                        <p>{{ Auth::user()->full_name }}</p>
                    </div>
                    <div class="data">
                        <h4>City:</h4>
                        <p>{{ Auth::user()->city }}</p>
                    </div>
                </div>
            </div>
            <div class="projects_data">
                <div class="data">
                    <h4>Email :</h4>
                    <p>{{ Auth::user()->email }}</p>
                </div>
                <div class="data">
                    <h4>Phone number :</h4>
                    <p>{{ Auth::user()->phone_number }}</p>
                </div>
            </div>

            <div class="social_media">
                <button style="height:34px"><a href="{{ route('logout') }}">Sign Out</a></button>
                <button style="height:34px"> <a href="{{ route('profile.update') }}">Update</a></button>
            </div>
        </div>
    </div>
    <script>
      document.getElementById('file').addEventListener('change', function() {
          document.getElementById('profile-picture-form').submit();
      });
  </script>
@endsection
