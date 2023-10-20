@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Driver</h2>
    <form action="{{ route('drivers.update', $driver) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" name="Name" class="form-control" value="{{ $driver->Name }}" required>
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" name="Email" class="form-control" value="{{ $driver->Email }}" required>
        </div>
        <div class="form-group">
            <label for="Phone_No">Phone Number</label>
            <input type="text" name="Phone_No" class="form-control" value="{{ $driver->Phone_No }}" required>
        </div>
        <div class="form-group">
            <label for="Residential_Address">Residential Address</label>
            <input type="text" name="Residential_Address" class="form-control" value="{{ $driver->Residential_Address }}" required>
        </div>
        <div class="form-group">
            <label for="CNIC_Number">CNIC Number</label>
            <input type="text" name="CNIC_Number" class="form-control" value="{{ $driver->CNIC_Number }}" required>
        </div>
        <div class="form-group">
            <label for="License_Number">License Number</label>
            <input type="text" name="License_Number" class="form-control" value="{{ $driver->License_Number }}" required>
        </div>
        <div class="form-group">
            <label for="car_id">Car ID</label>
            <input type="text" name="car_id" class="form-control" value="{{ $driver->car_id }}" required>
        </div><br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
