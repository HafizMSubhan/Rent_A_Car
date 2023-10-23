<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('driver')->paginate(10);
        // Pass the car data to the 'cars.index' view
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        // Display the form for creating a new car
        return view('cars.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'luggage_capacity' => 'required|integer',
            'person_capacity' => 'required|integer',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you want to upload images

        ]);

        // Create a new Car instance and populate it with the validated data
        $car = new Car();
        $car->name = $validatedData['name'];
        $car->model = $validatedData['model'];
        $car->number = $validatedData['number'];
        $car->luggage_capacity = $validatedData['luggage_capacity'];
        $car->person_capacity = $validatedData['person_capacity'];

        // Save the car record to the database
        $car->save();

        // Handle the uploaded pictures
        if ($request->hasFile('pictures')) {
            $pictures = [];
        
            foreach ($request->file('pictures') as $picture) {
                // Store each picture in a storage location of your choice
                $path = $picture->store('/car_pictures');
        
                // Store the path in the pictures array
                $pictures[] = $path;
            }
        
            // Convert the pictures array to JSON and save it in the 'pictures' column of the 'cars' table
            $car->pictures = json_encode($pictures);
            $car->save();
        }

        // Redirect to a success page or do something else
        return redirect()->route('cars.index')->with('success', 'Car added successfully');
    }

    public function show(Car $car)
    {

        // Pass the car data to the 'cars.show' view
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {

        // Pass the car data to the 'cars.edit' view
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $car_id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'luggage_capacity' => 'required|integer',
            'person_capacity' => 'required|integer',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you want to upload images
        ]);

        // Retrieve the car record from the database
        $car = Car::findOrFail($car_id);

        // Update the car record with the validated data
        $car->update([
            'name' => $validatedData['name'],
            'model' => $validatedData['model'],
            'number' => $validatedData['number'],
            'luggage_capacity' => $validatedData['luggage_capacity'],
            'person_capacity' => $validatedData['person_capacity'],
        ]);

        // Handle the uploaded pictures (if any)
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                // Store each picture in a storage location of your choice
                $path = $picture->store('car_pictures');
                
                // Attach the picture to the car
                $car->pictures()->create(['path' => $path]);
            }
        }

        // Redirect to a success page or do something else
        return redirect()->route('cars.index', $car->car_id)->with('success', 'Car updated successfully');
    }

    public function destroy($car_id)
    {
        $car = Car::findOrFail($car_id);
        // Delete associated pictures if necessary
        // Unlink the picture file using the stored path: unlink(storage_path('app/' . $car->pictures));
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
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

    public function getCarDetails(Request $request)
{
    try {
        $carId = $request->input('car_id');
        $car = Car::find($carId);

        if (!$car) {
            return response()->json(['error' => 'Car not found'], 404);
        }

        return response()->json(['car' => $car]);
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Error in getCarDetails: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}
}
