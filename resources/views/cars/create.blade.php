@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Car</h1>
        <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" id="model" name="model" required>
            </div>
            <div class="form-group">
                <label for="number">Number:</label>
                <input type="text" class="form-control" id="number" name="number" required>
            </div>
            <div class="form-group">
                <label for="luggage_capacity">Luggage Capacity:</label>
                <input type="number" class="form-control" id="luggage_capacity" name="luggage_capacity" required>
            </div>
            <div class="form-group">
                <label for="person_capacity">Person Capacity:</label>
                <input type="number" class="form-control" id="person_capacity" name="person_capacity" required>
            </div>
            <div class="form-group">
                <label for="pictures">Car Pictures:</label>
                <input type="file" class="form-control" id="pictures" name="pictures[]" multiple accept="image/*">
            </div><br>
            <button type="submit" class="btn btn-primary">Create Car</button>
        </form>
    </div>
@endsection
