@extends('layouts.app')
@section('content')

<div class="welcome-container">
    <div class="header">
        <a class="log-in" href="/login">Log in</a>
    </div>
    <div class="left-section">
        <div class="title">Just a few clicks away from making your working life a <i>lot</i> easier.</div>
        <p>Start working with Project Orange now</p>
        <base-button tag="a" type="white" class="shadow request-access-button" href="/request-access">Request access</base-button>
    </div>
    <div class="right-section">
        <img class="illustration" src="{{ Vite::asset('resources/images/dashboard_illustration.svg') }}" alt="illustration">
    </div>
</div>

@endsection