
<!doctype html>
<html lang="en">
@include('partials.user.head')
    <body>
        @include('partials.user.header')
        @yield('content')

        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('js/tiny-slider.js')}}"></script>
        <script src="{{asset('js/custom.js')}}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>