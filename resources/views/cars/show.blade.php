@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Car Details
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $car->name }}</h5>
                <p class="card-text">Model: {{ $car->model }}</p>
                <p class="card-text">Number: {{ $car->number }}</p>
                <p class="card-text">Luggage Capacity: {{ $car->luggage_capacity }}</p>
                <p class="card-text">Person Capacity: {{ $car->person_capacity }}</p>
                
                @if(isset($car->pictures) && is_array($car->pictures) && count($car->pictures) > 0)
                    <h2>Car Pictures:</h2>
                    <div class="row">
                        @foreach($car->pictures as $picture)
                            <div class="col-md-3">
                                <img src="{{ asset('path/to/pictures/' . $picture) }}" alt="Car Picture" class="img-thumbnail">
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('cars.edit', $car) }}" class="btn btn-info">Edit Car</a>
                    
                    <form action="{{ route('cars.destroy', $car) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this car?')">Delete Car</button>
                    </form>
                    
                    <a href="{{ route('cars.index') }}" class="btn btn-primary">Back to Car Listing</a>
                </div>
            </div>
        </div>
    </div>
@endsection
