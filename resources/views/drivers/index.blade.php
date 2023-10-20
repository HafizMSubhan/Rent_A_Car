@extends('layouts.app')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="font-size: 24px;">Driver List</h1>
        <a href="{{ route('drivers.create') }}" class="btn btn-primary" style="float: right;">Add Driver</a>
    </div>

    <table id="driver-table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Residential Address</th>
                <th>CNIC Number</th>
                <th>License Number</th>
                <th>Assigned Car</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drivers as $driver)
                <tr>
                    <td>{{ $driver->driver_id }}</td>
                    <td>{{ $driver->Name }}</td>
                    <td>{{ $driver->Email }}</td>
                    <td>{{ $driver->Phone_No }}</td>
                    <td>{{ $driver->Residential_Address }}</td>
                    <td>{{ $driver->CNIC_Number }}</td>
                    <td>{{ $driver->License_Number }}</td>
                    <td>{{ $driver->car->name }}</td>
                    <td>
                        <a href="{{ route('drivers.show', $driver) }}" class="btn btn-info">View</a>
                        <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-primary">Edit</a>
                        <!-- Add a Delete button that submits a form to the destroy route -->
                        <form action="{{ route('drivers.destroy', $driver) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Driver?')">Delete</button>
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
            console.log('Document is ready.');
            $('#driver-table').DataTable({
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
