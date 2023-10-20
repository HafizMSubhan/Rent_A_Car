@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Driver Details</h2>
    <div class="card">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Name:</strong> {{ $driver->Name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $driver->Email }}</li>
                <li class="list-group-item"><strong>Phone Number:</strong> {{ $driver->Phone_No }}</li>
                <li class="list-group-item"><strong>Residential Address:</strong> {{ $driver->Residential_Address }}</li>
                <li class="list-group-item"><strong>CNIC Number:</strong> {{ $driver->CNIC_Number }}</li>
                <li class="list-group-item"><strong>License Number:</strong> {{ $driver->License_Number }}</li>
                <li class="list-group-item"><strong>Car Name:</strong> {{ $driver->car->name }}</li>
                <li class="list-group-item"><strong>Car Model:</strong> {{ $driver->car->model }}</li>
            </ul>
        </div>
    </div>
    <br>
    <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
