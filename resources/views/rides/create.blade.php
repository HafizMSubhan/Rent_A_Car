@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Ride Booking</h1>
    <form method="POST" action="{{ route('rides.store') }}">
        @csrf

        <div class="row">
            <!-- Column 1: Persons and Luggage, Date and Time -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="persons">Number of Persons</label>
                    <input type="number" name="persons" id="persons" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="luggage">Number of Luggage Items</label>
                    <input type="number" name="luggage" id="luggage" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="date_time">Date & Time</label>
                    <input type="datetime-local" name="date_time" id="date_time" class="form-control" required>
                </div>
            </div>

            <!-- Column 2: Distance and Total Price -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="total_distance">Total Distance (km)</label>
                    <input type="number" step="0.01" name="total_distance" id="total_distance" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="totalPrice">Total Price</label>
                    <input type="text" name="totalPrice" id="totalPrice" class="form-control" disabled>
                </div>
            </div>
        </div>

        <div class="text-center">
            <div class="form-group" id="fetch-button">
                <button type="button" id="fetch-cars-button" class="btn btn-primary" style="margin-top: 20px; padding: 10px;">Fetch Available Cars</button>
            </div>
        </div>
    </form>
</div><br><br>

<div class="container">
    <div class="row" id="car-container">
        {{-- Car cards will be displayed here --}}
    </div>
</div>

<div class="container">
    <div class="row" id="selected-car-details" style="display: none;">
        {{-- Selected car details will be displayed here --}}
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to enable or disable the "Create Ride Booking" button based on form validation
        function updateCreateRideButton() {
            var persons = $('#persons').val();
            var luggage = $('#luggage').val();
            var totalDistance = $('#total_distance').val();
            
            var isValid = persons > 0 && luggage >= 0 && totalDistance > 0;
            $('#create-ride-button').prop('disabled', !isValid);
            
            // Calculate the total price based on the total distance and pricing rate
            var pricingRate = {{ $pricingRate }}; // You should have this value available
            var totalPrice = parseFloat(totalDistance) * pricingRate;
            $('#totalPrice').val(totalPrice.toFixed(2));
        }
        
        function fetchAvailableCars() {
            // Collect the data entered by the user
            var persons = $('#persons').val();
            var luggage = $('#luggage').val();
            var totalDistance = $('#total_distance').val();
            
            // Create a data object to send via AJAX
            var requestData = {
                persons: persons,
                luggage: luggage,
                total_distance: totalDistance,
            };
            
            $.ajax({
                url: '{{ route('get.available.cars') }}',
                method: 'POST',
                data: requestData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    // Handle the server's response
                    if (data.hasOwnProperty('cars')) {
                        var cars = data.cars;
                        var carContainer = $('#car-container');
                        carContainer.empty(); // Clear previous results
                        
                        // Iterate through the available cars and create cards
                        $.each(cars, function (index, car) {
                            var carCard = `
                                <div class="col-md-4">
                                    <div class="card mb-4" style='text-align:center;'>
                                        <!-- Car card content -->
                                        <div id="carImages-${car.id}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <!-- Car images here -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">${car.name}</h5>
                                            <p class="card-text">Model: ${car.model}</p>
                                            <p class="card-text">Number: ${car.number}</p>
                                            <p class="card-text">Luggage Capacity: ${car.luggage_capacity} items</p>
                                            <p class="card-text">Person Capacity: ${car.person_capacity} people</p>
                                            <button class="btn btn-primary select-car-button" data-car-id="${car.id}">Select Car</button>
                                        </div>
                                    </div>
                                </div>
                            `;

                            carContainer.append(carCard);
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the error, if any
                    console.error("Error: " + error);
                }
            });
        }

        // Attach event listeners to input fields for validation
        $('#persons, #luggage, #total_distance').on('input', function () {
            updateCreateRideButton();
        });

        // Attach an event listener to the "Fetch Available Cars" button
        $('#fetch-cars-button').on('click', function () {
            fetchAvailableCars();
        });

        // Initial validation and state of the "Create Ride Booking" button
        updateCreateRideButton();
    });

    // Add event listener for car selection
    $(document).on('click', '.select-car-button', function () {
        console.log('Select Car button clicked'); // Debugging statement
        var carId = $(this).data('car-id');
        console.log('Car ID:', carId); // Debugging statement
    var carId = $(this).data('car-id');
    if (carId) {
        // Send an AJAX request to get car details
        $.ajax({
            url: '{{ route('get.car.details') }}',
            method: 'POST',
            data: { car_id: carId },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.hasOwnProperty('car')) {
                    var car = data.car;

                    // Redirect to the selected_car route with the selected car details
                    window.location.href = '{{ route('selected_car') }}' +
                        '?car_id=' + car.id +
                        '&name=' + car.name +
                        '&model=' + car.model +
                        '&number=' + car.number +
                        '&luggage_capacity=' + car.luggage_capacity +
                        '&person_capacity=' + car.person_capacity +
                        '&selectedCarPrice=' + selectedCarPrice.toFixed(2);
                }
            },
            error: function (xhr, status, error) {
                // Handle the error, if any
                console.error("Error: " + error);
            }
        });
    }
});
</script>
@endsection
