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
                <div class="form-group" id="total-price">
                    <label for="total_price">Total Price</label>
                    <input type="text" name="total_price" id="total_price" class="form-control" disabled>
                </div>
            </div>
        </div>

        <div class="text-center">
            <div class="form-group" id="fetch-button">
                <button type="button" id="fetch-cars-button" class="btn btn-primary" style="margin-top: 20px; padding: 10px;">Fetch All Cars</button>
            </div>
        </div><br><br>

        <div id="car-container" class="row">
            <!-- Car cards will be displayed here -->
        </div>

        <div class="text-center">
            <div class="form-group" id="create-button" style="display: none;">
                <button type="submit" class="btn btn-success" id="create-ride-button" disabled>Create Ride Booking</button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to enable or disable the "Create Ride Booking" button based on form validation
        function updateCreateRideButton() {
            var persons = $('#persons').val();
            var luggage = $('#luggage').val();
            var totalDistance = $('#total_distance').val();
            var carId = $('#car_id').val();

            var isValid = persons > 0 && luggage >= 0 && totalDistance > 0 && carId !== '';
            $('#create-ride-button').prop('disabled', !isValid);

            // Calculate the total price based on the total distance and pricing rate
            var pricingRate = {{ $pricingRate }}; // You should have this value available
            var totalPrice = parseFloat(totalDistance) * pricingRate;
            $('#total_price').val(totalPrice.toFixed(2));
        }

        // Predefined list of cars (sample data)
        var cars = [
            { id: 1, name: 'Car 1', price: 50, image: 'car1.jpg' },
            { id: 2, name: 'Car 2', price: 60, image: 'car2.jpg' },
            { id: 3, name: 'Car 3', price: 70, image: 'car3.jpg' },
        ];

        // Display predefined cars
        var carContainer = $('#car-container');
        carContainer.empty();
        var carSlideShow = '<div class="slideshow-container">';
        $.each(cars, function (index, car) {
            var carCard = `
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('car_images/') }}/${car.image}" alt="${car.name}" style="width:100%">
                        <div class="card-body">
                            <h5 class="card-title">${car.name}</h5>
                            <p class="card-text">Price: $${car.price}</p>
                            <button class="btn btn-primary select-car-button" data-car-id="${car.id}">Select Car</button>
                        </div>
                    </div>
                </div>
            `;
            carContainer.append(carCard);
            carSlideShow += `
                <div class="mySlides">
                    <img src="{{ asset('car_images/') }}/${car.image}" style="width:100%">
                </div>
            `;
        });
        carSlideShow += '</div>';
        carContainer.append(carSlideShow);

        // Show the "Select Car" field, the "Total Price" field, and the "Create Ride Booking" button
        $('#car-selection').show();
        $('#total-price').show();
        $('#create-button').show();

        // Enable the "Create Ride Booking" button
        $('#create-ride-button').prop('disabled', false);

        // Add event listener for car selection
        $('.select-car-button').on('click', function () {
            var carId = $(this).data('car-id');
            $('#car_id').val(carId);

            // Update the button state
            updateCreateRideButton();
        });

        // Initial validation and state of the "Create Ride Booking" button
        updateCreateRideButton();
    });

    // Function to start the car image slideshow
    var slideIndex = 0;

    function showSlides() {
        var slides = $(".mySlides");
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 2000); // Change image every 2 seconds
    }

    // Start the slideshow
    showSlides();
</script>
@endsection
