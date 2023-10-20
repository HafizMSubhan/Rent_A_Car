@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Driver</h2>
    <form action="{{ route('drivers.store') }}" method="POST">
        @csrf

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

        <div class="form-group">
            <label for="car_id">Car ID</label>
            <select name="car_id" id="car_id" class="form-control" required>
                <option value="" disabled selected>Select Car</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Create Driver</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Add the CSRF token to the AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // When the document is ready, populate the car dropdown with available cars using AJAX
    $(document).ready(function () {
        // AJAX request to get the available cars
        $.get('{{ route('get.available.cars') }}', function (data) {
            var carSelect = $('#car_id');
            carSelect.empty();
            carSelect.append($('<option value="" disabled selected>Select Car</option>'));

            $.each(data.cars, function (index, car) {
                carSelect.append($('<option value="' + car.car_id + '">' + car.car_id + '</option>'));
            });
        });
    });
</script>
@endsection
