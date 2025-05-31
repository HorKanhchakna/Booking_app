@extends('layouts.Admin')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        .card-img-top {
            object-fit: cover;
            height: 200px;
            width: 100%;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 1rem;
        }

        .dashboard-container {
            margin-bottom: 2rem;
        }
    </style>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Dashboard Section -->
    <div id="dashboard" class="dashboard-container section active">
        <h2>Dashboard</h2>

        <!-- Destination Summary -->
        <h4 class="mt-4 mb-3">Destinations</h4>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($destinations as $destination)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ $destination->image }}" class="card-img-top" alt="{{ $destination->name }}" />
                        <div class="card-body">
                            <h5 class="card-title">{{ $destination->name }}</h5>
                            <p class="card-text">Discount: {{ $destination->discount }}%</p>
                            <p class="card-text">{{ $destination->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Target Summary -->
        <h4 class="mt-5 mb-3">Targets</h4>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Max People</th>
                        <th>Price</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr>
                            <td>{{ $package->title }}</td>
                            <td>{{ $package->location }}</td>
                            <td>{{ $package->duration }}</td>
                            <td>{{ $package->max_people }}</td>
                            <td>${{ number_format($package->price, 2) }}</td>
                            <td>{{ $package->rating }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Booking Section -->
    <div id="booking" class="dashboard-container section">
        <h2 class="text-center mb-4">User Bookings</h2>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark text-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date & Time</th>
                        <th>Destination</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->email }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->package->title ?? 'N/A' }}</td>
                            <td>{{ $booking->notes ?? 'No notes' }}</td>
                            <td>
                                <form action="{{ route('bookings.approve', $booking->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Destination Section -->
    <div id="destination" class="dashboard-container section">
        <h2>Destinations</h2>
        <h4 class="mt-4 mb-3">Add New Destination</h4>
        <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" required>
                @error('discount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Destination</button>
        </form>
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">
            @foreach ($destinations as $destination)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ $destination->image }}" class="card-img-top" alt="{{ $destination->name }}" />
                        <div class="card-body">
                            <h5 class="card-title">{{ $destination->name }}</h5>
                            <p class="card-text">Discount: {{ $destination->discount }}%</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Target Section -->
    <div id="target" class="dashboard-container section">
        <h2>Target Packages</h2>
        <div class="table-responsive mt-3">
            <table class="table table-bordered align-middle">
                <thead class="table-info">
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Max People</th>
                        <th>Price</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr>
                            <td>{{ $package->name ?? 'N/A' }}</td>
                            <td>{{ $package->title }}</td>
                            <td>{{ $package->location }}</td>
                            <td>{{ $package->duration }}</td>
                            <td>{{ $package->max_people }}</td>
                            <td>${{ number_format($package->price, 2) }}</td>
                            <td>{{ $package->rating }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection