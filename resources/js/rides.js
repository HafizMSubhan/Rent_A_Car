// In resources/js/rides.js
$(document).ready(function () {
    // Assuming you have two select elements with IDs 'car_id' and 'driver_id'
    var carSelect = $('#car_id');
    var driverSelect = $('#driver_id');

    // Make an AJAX request to get available cars and drivers
    $.get('/get-available-cars-drivers', function (data) {
        // Update the car dropdown
        carSelect.empty();
        carSelect.append($('<option></option>').attr('value', '').text('Select a car'));
        $.each(data.cars, function (index, car) {
            carSelect.append($('<option></option>').attr('value', car.car_id).text(car.name));
        });

        // Update the driver dropdown
        driverSelect.empty();
        driverSelect.append($('<option></option>').attr('value', '').text('Select a driver'));
        $.each(data.drivers, function (index, driver) {
            driverSelect.append($('<option></option>').attr('value', driver.driver_id).text(driver.Name));
        });
    });
});
