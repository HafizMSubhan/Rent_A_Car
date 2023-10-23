<!-- resources/views/selected_car.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Selected Car Details</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $car->name }}</h5>
            <p class="card-text">Model: {{ $car->model }}</p>
            <p class="card-text">Number: {{ $car->number }}</p>
            <p class="card-text">Luggage Capacity: {{ $car->luggage_capacity }} items</p>
            <p class="card-text">Person Capacity: {{ $car->person_capacity }} people</p>
            <p class="card-text">Total Price: {{ $selectedCarPrice }}</p>
        </div>
    </div>
</div>
@endsection