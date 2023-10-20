<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Car;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\RideBooking;

class RidesController extends Controller
{
    public function index()
    {
        $rideBookings = RideBooking::paginate(10);
        return view('rides.index', compact('rideBookings'));
    }

    public function create()
{
    // Fetch car data from your database (you may need to customize this query)
    $cars = Car::all(); // Retrieve only three cars

    // Pass the car data to the view
    return view('rides.create', [
        'cars' => $cars, // Pass the $cars variable to the view
        'pricingRate' => 10, // Replace with your actual pricing rate
    ]);
}
public function showRideDetails(Request $request)
{
    $car_id = $request->input('car_id');
    $persons = $request->input('persons');
    $luggage = $request->input('luggage');
    $dateTime = $request->input('date_time');
    $totalDistance = $request->input('total_distance');
    $totalPrice = $request->input('totalPrice');

    // Fetch car details based on $carId
    $car = Car::find($car_id);

    if (!$car) {
        // Handle the case where the car is not found
        // You can redirect the user or show an error message
    }

    return view('ride-details', [
        'car_id' => $car_id,
        'persons' => $persons,
        'luggage' => $luggage,
        'date_time' => $dateTime,
        'total_distance' => $totalDistance,
        'totalPrice' => $totalPrice,
        'car' => $car, // Pass the car details
    ]);
}


public function getAvailableCars(Request $request) {
    // Retrieve the data sent via the AJAX request
    $persons = $request->input('persons');
    $luggage = $request->input('luggage');
    $totalDistance = $request->input('total_distance');
    $totalPrice = $request->input('totalPrice'); // Include the total price

    // Store the data in the session
    $request->session()->put('persons', $persons);
    $request->session()->put('luggage', $luggage);
    $request->session()->put('total_distance', $totalDistance);
    $request->session()->put('totalPrice', $totalPrice); // Store the total price in the session

    // Retrieve all available cars from the database
    $availableCars = Car::where('person_capacity', '>=', $persons)
        ->where('luggage_capacity', '>=', $luggage)
        ->get();

    // Return the results as JSON
    return response()->json(['cars' => $availableCars]);
}

public function store(Request $request)
{
    $data = $request->validate([
        'persons' => 'required|integer',
        'luggage' => 'required|integer',
        'total_distance' => 'required|numeric',
        'date_time' => 'required|date',
        'car_id' => 'required|exists:cars,car_id',
    ]);

    // Calculate the total price based on the total distance and pricing rate
    $pricingRate = Setting::where('key', 'rate_per_km')->value('value');
    $totalPrice = $data['total_distance'] * $pricingRate;

    // Create a new RideBooking record
    $rideBooking = new RideBooking();
    $rideBooking->persons = $data['persons'];
    $rideBooking->luggage = $data['luggage'];
    $rideBooking->total_distance = $data['total_distance'];
    $rideBooking->date_time = $data['date_time'];
    $rideBooking->car_id = $data['car_id'];
    $rideBooking->totalPrice = $totalPrice;

    $rideBooking->save();

    return redirect()->route('rides.index')->with('success', 'Ride added successfully');
}

    public function show(RideBooking $rideBooking)
    {
        return view('rides.show', compact('rideBooking'));
    }

    public function edit(RideBooking $rideBooking)
{
    return view('rides.edit', compact('rideBooking'));
}

    public function update(Request $request, RideBooking $rideBooking)
    {
        $data = $request->validate([
            'persons' => 'required|integer',
            'luggage' => 'required|integer',
            'total_distance' => 'required|numeric',
            'date_time' => 'required|date',
            'car_id' => 'required|exists:cars,car_id',
        ]);

        $rideBooking->update($data);

        return redirect()->route('rides.index')->with('success', 'Ride updated successfully');
    }

    public function destroy(RideBooking $rideBooking)
    {
        $rideBooking->delete();
        return redirect()->route('rides.index');
    }
    public function getUnassignedCars()
    {
        $availableCars = Car::doesntHave('rideBooking')->get();
        return response()->json(['cars' => $availableCars]);
    }  

    
    
}
