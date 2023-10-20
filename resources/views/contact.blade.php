@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Contact Us</h1>
                    <p class="text-center">If you have any questions or need to get in touch with us, please use the contact information below:</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope"></i> Email: <a href="mailto:contact@example.com">contact@example.com</a></li>
                        <li><i class="fas fa-phone"></i> Phone: +1 (123) 456-7890</li>
                        <li><i class="fas fa-map-marker-alt"></i> Address: 123 Main St, City, Country</li>
                    </ul>
                    <!-- Add a contact form or additional information as needed -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
