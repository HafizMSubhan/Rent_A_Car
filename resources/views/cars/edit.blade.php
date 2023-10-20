@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Car</h2>
        <form method="POST" action="{{ route('cars.update', $car->car_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $car->name }}" required>
            </div>
            <div class="form-group">
                <label for "model">Model:</label>
                <input type="text" name="model" class="form-control" value="{{ $car->model }}" required>
            </div>
            <div class="form-group">
                <label for="number">Number:</label>
                <input type="text" name="number" class="form-control" value="{{ $car->number }}" required>
            </div>
            <div class="form-group">
                <label for="luggage_capacity">Luggage Capacity:</label>
                <input type="number" name="luggage_capacity" class="form-control" value="{{ $car->luggage_capacity }}" required>
            </div>
            <div class="form-group">
                <label for="person_capacity">Person Capacity:</label>
                <input type="number" name="person_capacity" class="form-control" value="{{ $car->person_capacity }}" required>
            </div>
            <!-- If you want to allow updating pictures, you can add a file input here -->
            <!-- Example:-->
            <div class="form-group">
                <label for="pictures">Car Pictures:</label>
                <input type="file" name="pictures[]" class="form-control" multiple accept="image/*">
            </div><br>
            
            <button type="submit" class="btn btn-primary">Update Car</button>
        </form>
    </div>
@endsection
