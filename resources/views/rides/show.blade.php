
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ride Booking Details</h1>
    <a href="{{ route('rides.index') }}" class="btn btn-primary">Back to List</a>
    
    <div class="card mt-3">
        <div class="card-header">
            Ride Booking Information
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $rideBooking->ride_id }}</p>
            <p><strong>Number of Persons:</strong> {{ $rideBooking->persons }}</p>
            <p><strong>Number of Luggage Items:</strong> {{ $rideBooking->luggage }}</p>
            <p><strong>Total Distance (km):</strong> {{ $rideBooking->total_distance }} km</p>
            <p><strong>Date & Time:</strong> {{ $rideBooking->date_time }}</p>
            <p><strong>Car:</strong>{{ $rideBooking->car ? $rideBooking->car->name : 'N/A' }}</p>
        </div>
    </div>
</div>
@endsection
