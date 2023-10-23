<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
    
    
    
    
    <!-- Add DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.10/js/dataTables.bootstrap4.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        .navbar {
        background: linear-gradient(135deg, #0D1137, #384C70, #0D1137);
        background-size: 400% 400%;
        animation: gradientAnimation 6s infinite;
        padding: 10px 20px; /* Add padding to increase width and create space */
    }

    .navbar .nav-item {
        margin-right: 10px; /* Add margin between nav items (buttons) */
    }

    @keyframes gradientAnimation {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
        /* Style for primary buttons (e.g., login and register buttons) */
        .btn-primary {
        background-color: #007BFF; /* Blue color */
        color: #fff; /* Text color */
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Darker blue color on hover */
    }

    /* Style for secondary buttons (e.g., logout button) */
    .btn-secondary {
        background-color: #FF5733; /* Orange color */
        color: #fff; /* Text color */
        border: none;
    }

    .btn-secondary:hover {
        background-color: #D8410D; /* Darker orange color on hover */
    }
    .navbar-brand-text {
        color: white;
        font-weight: bold;
    }
    /* Style for the dropdown menu items */
    .dropdown-menu a {
        color: #000; /* Text color for dropdown items */
    }

    .dropdown-menu a:hover {
        background-color: #D8410D; /* Background color on hover */
        color: #fff; /* Text color on hover */
    }

    /* Style for the "Logout" button */
    .dropdown-menu .btn-logout {
        background-color: #FF5733; /* Orange color for the button */
        border: none;
    }

    .dropdown-menu .btn-logout:hover {
        background-color: #D8410D; /* Darker orange color on hover */
    }

    /* Add any additional button styles as needed */
    </style>

</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background: linear-gradient(135deg, #0D1137, #384C70, #0D1137); padding: 10px 20px;">
    <div class="container">
        <a class="navbar-brand navbar-brand-text" href="{{ url('/') }}" style="color: #fff; font-weight: bold;">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}" style="color: #fff;">{{ __('Home') }}</a>
                </li>
                @if (Auth::check() && Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cars.index') }}" style="color: #fff;">{{ __('Cars') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('drivers.index') }}" style="color: #fff;">{{ __('Drivers') }}</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rides.index') }}" style="color: #fff;">{{ __('Rides') }}</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}" style="color: #fff;">{{ __('About') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}" style="color: #fff;">{{ __('Contact') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color: #fff;">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color: #fff;">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #fff;">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
