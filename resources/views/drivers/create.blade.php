@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="margin-bottom: 20px;">Add Driver</h2>
    <form action="{{ route('drivers.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="Name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" name="Email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="Phone_No">Phone Number</label>
                    <input type="text" name="Phone_No" class="form-control" required>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Residential_Address">Residential Address</label>
                    <input type="text" name="Residential_Address" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="CNIC_Number">CNIC Number</label>
                    <input type="text" name="CNIC_Number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="License_Number">License Number</label>
                    <input type="text" name="License_Number" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="car_id">Car</label>
            <select name="car_id" id="car_id" class="form-control" required>
                <option value="" disabled selected>Select Car</option>
            </select>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="width: 150px;">Create Driver</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        var unassignedCars = @json($unassignedCars);

        var carSelect = $('#car_id');
        carSelect.empty(); // Clear existing options

        // Add a default option
        carSelect.append($('<option value="" disabled selected>Select Car</option>'));

        // Populate the car options with unassigned cars using their names
        $.each(unassignedCars, function (index, car) {
            carSelect.append($('<option value="' + car.car_id + '">' + car.name + '</option>'));
        });
    });
</script>
@endsection
