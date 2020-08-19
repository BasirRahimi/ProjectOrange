@extends('layouts.app')
@section('content')

<div class="request-access-container">
    <div class="header">
        <a class="log-in" href="/login">Log in</a>
    </div>
    <div class="router-view">
        <router-view></router-view>
    </div>
    <div class="footer">
        <p>By confirming your email, you agree to our <a href="#">Terms of Service</a> and that you have read and understood our <a href="#">Privacy Policy</a></p>
    </div>
</div>

@endsection