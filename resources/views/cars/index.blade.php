@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 24px;">Car Listing</h1>
            <a href="{{ route('cars.create') }}" class="btn btn-primary">Add Car</a>
        </div>
        <table id="car-table" class="display">
            <thead>
                <tr>
                    <th>Car ID</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Number</th>
                    <th>Luggage Capacity</th>
                    <th>Person Capacity</th>
                    <th>Assigned Driver</th> <!-- New column for the assigned driver -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td>{{ $car->car_id }}</td>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->number }}</td>
                    <td>{{ $car->luggage_capacity }}</td>
                    <td>{{ $car->person_capacity }}</td>
                    <td>
                        @if($car->driver)
                            {{ $car->driver->Name }}
                        @else
                            Not Assigned
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-success">View</a>
                        
                        <!-- Edit Button -->
                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-info">Edit</a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this car?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <style>
        /* Custom CSS styles for the table and buttons */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: #fff;
        }
        td {
            border: 1px solid #ccc;
        }
        .btn {
            margin: 5px;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('#car-table').DataTable({
                // Enable sorting for all columns
                "order": [],
                // Enable searching
                "searching": true,
                // Enable pagination with default page length
                "paging": true,
                "pageLength": 10, // Set the number of items per page
                // Additional configuration options can be added here
            });
        });
    </script>
@endsection
