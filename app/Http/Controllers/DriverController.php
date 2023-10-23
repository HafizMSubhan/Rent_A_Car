<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Car;
use Illuminate\Validation\Rule;


class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::paginate(10);
        
        return view('drivers.index', compact('drivers'));
    }
    public function create()
{
    $unassignedCars = Car::doesntHave('driver')->get(); // Fetch cars that don't have a driver

    return view('drivers.create', compact('unassignedCars'));
}

    public function getAvailableCars()
    {
        $cars = Car::all(); // Replace 'Car' with your actual Car model name.
    
        return response()->json(['cars' => $cars]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Name' => 'required|string',
            'Email' => 'required|email|unique:drivers',
            'Phone_No' => 'required|string',
            'Residential_Address' => 'required|string',
            'CNIC_Number' => 'required|string|unique:drivers',
            'License_Number' => 'required|string',
            'car_id' => 'required|exists:cars,car_id',
        ]);

        // Create a new Car instance and populate it with the validated data
        $driver = new Driver();
        $driver->Name = $data['Name'];
        $driver->Email = $data['Email'];
        $driver->Phone_No = $data['Phone_No'];
        $driver->Residential_Address = $data['Residential_Address'];
        $driver->CNIC_Number = $data['CNIC_Number'];
        $driver->License_Number = $data['License_Number'];
        $driver->car_id = $data['car_id'];

        // Save the car record to the database
        $driver->save();
        return redirect()->route('drivers.index')->with('success', 'Driver added successfully');
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
    $data = $request->validate([
        'Name' => 'required|string',
        'Email' => [
            'required',
            'email',
            Rule::unique('drivers')->ignore($driver->driver_id, 'driver_id'),
        ],
        'Phone_No' => 'required|string',
        'Residential_Address' => 'required|string',
        'CNIC_Number' => [
            'required',
            'string',
            Rule::unique('drivers')->ignore($driver->driver_id, 'driver_id'),
        ],
        'License_Number' => 'required|string',
        'car_id' => 'required|exists:cars,car_id',
    ]);

    $driver->update($data);

    return redirect()->route('drivers.index')->with('success', 'Driver updated successfully');
    }


    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }

}
