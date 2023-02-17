<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @hasSection('title')- @yield('title') @endif</title>

    {{-- @if($client ?? '')
    <script>
        window.clientId = {{$client->id}};
    </script>
    @endif --}}

    <!-- Scripts / Styles -->
    @vite(['resources/js/app.js'])

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/lxw2fcr.css">
</head>
<body>
    <div id="app">
        <?php $user = Auth::user(); ?>
        @if($user)
        @if ($user->has_access)
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white shadow-sm header-nav p-0 px-lg-3 py-lg-2">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fas fa-bars"></i>
                </button> --}}

                {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}
                <div>
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <base-dropdown tag="li" class="nav-item" menu-classes="shadow" position="right">
                            <template v-slot:title>
                                <base-button type="link" class="dropdown-toggle m-0 nav-link">
                                {{ $user->name }} <span class="caret"></span>
                                 </base-button>
                            </template>
                            
                            <a href="{{ route('dashboard') }}" class="dropdown-item">{{ __('Dashboard') }}</a>

                            @if($user->role < 2)
                                <a href="{{ route('grant-access') }}" class="dropdown-item">{{ __('Access control') }}</a>
                            @endif
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </base-dropdown>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif
        @endif

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
