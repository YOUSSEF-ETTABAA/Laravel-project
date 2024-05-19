
@if (Auth::check())
    @if (Auth::user()->role === 'user')
        @include('user.UserProfile')
    @else
    @include('user.login')
    @endif
@else
    @include('user.login')
@endif

