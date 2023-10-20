<!-- resources/views/admin/settings.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Settings</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.update') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="rate_per_km" class="form-label">Rate per Kilometer (PKR)</label>
                                <input type="number" class="form-control" id="rate_per_km" name="rate_per_km" value="{{ $ratePerKm }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        <a class="btn btn-secondary mt-3" href="{{ route('home') }}">Back to Home</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
