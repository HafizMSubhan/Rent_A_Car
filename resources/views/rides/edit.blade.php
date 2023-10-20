@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ride Booking</h1>    
    <form method="POST" action="{{ route('rides.update', ['rideBooking' => $rideBooking]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="persons">Number of Persons</label>
            <input type="number" name="persons" id="persons" class="form-control" value="{{ $rideBooking->persons }}" required>
        </div>

        <div class="form-group">
            <label for="luggage">Number of Luggage Items</label>
            <input type="number" name="luggage" id="luggage" class="form-control" value="{{ $rideBooking->luggage }}" required>
        </div>

        <div class="form-group">
            <label for="total_distance">Total Distance (km)</label>
            <input type="number" step="0.01" name="total_distance" id="total_distance" class="form-control" value="{{ $rideBooking->total_distance }}" required>
        </div>

        <div class="form-group">
            <label for="date_time">Date & Time</label>
            <input type="datetime-local" name="date_time" id="date_time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($rideBooking->date_time)) }}" required>
        </div>

        <div class="form-group">
            <label for="car_id">Select Car</label>
            <select name="car_id" id="car_id" class="form-control" required>
                @foreach ($cars as $car)
                    <option value="{{ $car->car_id }}" {{ $car->car_id === $rideBooking->car_id ? 'selected' : '' }}>
                        {{ $car->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Update Ride Booking</button>
    </form>
</div>
@endsection
