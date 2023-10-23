@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <!-- Add buttons with updated labels and CSS styles -->
                    <div class="mt-4">
                        <a href="{{ route('cars.index') }}" class="btn btn-primary custom-button">
                            View Cars
                        </a><br>
                        <a href="{{ route('drivers.index') }}" class="btn btn-primary custom-button">
                            View Drivers
                        </a><br>
                        <a href="{{ route('rides.index') }}" class="btn btn-primary custom-button">
                            View Rides
                        </a><br>
                        <a href="{{ route('settings') }}" class="btn btn-primary custom-button">
                            Settings
                        </a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom CSS styles for the buttons */
    .custom-button {
        margin: 5px;
        padding: 10px 20px;
        font-size: 18px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .custom-button:hover {
        background-color: #2980b9;
    }
</style>
@endsection
