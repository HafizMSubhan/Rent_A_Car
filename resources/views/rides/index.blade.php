@extends('layouts.app')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Rides List</h2>
        <a href="{{ route('rides.create') }}" class="btn btn-primary" style="float: right;">Book a Ride</a>
    </div>
    
    <div class="table-responsive">
        <table id="rides-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Persons</th>
                    <th>Luggage</th>
                    <th>Total Distance (km)</th>
                    <th>Date & Time</th>
                    <th>Car</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rideBookings as $rideBooking)
                    <tr>
                        <td>{{ $rideBooking->ride_id }}</td>
                        <td>{{ $rideBooking->persons }}</td>
                        <td>{{ $rideBooking->luggage }}</td>
                        <td>{{ $rideBooking->total_distance }}</td>
                        <td>{{ $rideBooking->date_time }}</td>
                        <td>{{ $rideBooking->car->name }}</td>
                        <td>
                            <a href="{{ route('rides.show', $rideBooking) }}" class="btn btn-info">View</a>
                            <form action="{{ route('rides.destroy', $rideBooking) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ride booking?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<style>
    /* Custom CSS styles for the table and buttons */
    .table {
        width: 100%;
    }
    .table th, .table td {
        text-align: center; /* Center-align table content */
    }
    .btn {
        margin: 5px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#rides-table').DataTable({
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
