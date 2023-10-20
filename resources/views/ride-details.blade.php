@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Ride Booking Details</h1>
    <!-- Display user inputted data -->
    <p><strong>Number of Persons:</strong> {{ $persons }}</p>
    <p><strong>Number of Luggage Items:</strong> {{ $luggage }}</p>
    <p><strong>Date & Time:</strong> {{ $date_time }}</p>
    <p><strong>Total Distance (km):</strong> {{ $total_distance }}</p>
    <p><strong>Total Price:</strong> ${{ $totalPrice }}</p>

    <!-- Display the selected car details -->
    <h2>Selected Car</h2>
    <div class="col-md-4">
        <div class="card">
            <div id="carImageCarousel-{{ $car->car_id }}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach(json_decode($car->pictures) as $key => $picture)
                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                            <img src="{{ asset('storage/' . $picture) }}" class="d-block w-100" alt="Car Picture">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carImageCarousel-{{ $car->car_id }}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carImageCarousel-{{ $car->car_id }}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" ariahidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $car->name }}</h5>
                <p class="card-text">Model: {{ $car->model }}</p>
                <p class="card-text">Number: {{ $car->number }}</p>
                <p class="card-text">Luggage Capacity: {{ $car->luggage_capacity }} items</p>
                <p class="card-text">Person Capacity: {{ $car->person_capacity }} people</p>
                <p class="card-text">Price: ${{ $car->price }}</p>
                <!-- Add more car details here -->
            </div>
        </div>
    </div>

    <!-- Create Booking button -->
    <form method="POST" action="{{ route('rides.store') }}">
        @csrf
        <input type="hidden" name="car_id" value="{{ $car->car_id }}">
        <!-- Include other hidden fields for user inputted data -->
        <button type="submit" class="btn btn-success">Create Booking</button>
    </form>
</div>
@endsection
