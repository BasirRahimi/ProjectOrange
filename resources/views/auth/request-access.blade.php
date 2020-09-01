@extends('layouts.app')
@section('content')

<div class="request-access-container">
    <div class="header">
        @auth
        <a class="log-in" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Log out</a>
        @endauth
        @guest
        <a class="log-in" href="/login">Log in</a>
        @endguest
    </div>
    <div class="router-view">
        <request-access user-prop="{{ $user }}"></request-access>
    </div>
    <div class="footer">
        <p>By confirming your email, you agree to our <a href="#">Terms of Service</a> and that you have read and understood our <a href="#">Privacy Policy</a></p>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

@endsection