<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;

class AdminController extends Controller
{
    public function index()
    {
        $cars = Car::paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
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
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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
                $path = $picture->store('car_pictures');

                // Store the path in the pictures array
                $pictures[] = $path;
            }

            // Convert the pictures array to JSON and save it in the 'pictures' column of the 'cars' table
            $car->pictures = json_encode($pictures);
            $car->save();
        }

        // Redirect to a success page or do something else
        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully');
    }

    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'luggage_capacity' => 'required|integer',
            'person_capacity' => 'required|integer',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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
        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully');
    }

    public function destroy(Car $car)
    {
        // Delete associated pictures if necessary
        if ($car->pictures) {
            foreach (json_decode($car->pictures) as $picture) {
                // Unlink the picture file using the stored path
                unlink(storage_path('app/' . $picture));
            }
        }

        // Delete the car record
        $car->delete();

        // Redirect to a success page or do something else
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully');
    }
}