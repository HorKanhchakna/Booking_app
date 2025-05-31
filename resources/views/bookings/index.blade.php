{{-- 
C

 --}}



 @extends('layouts.Admin')

@section('title', 'Admin Dashboard')

@section('content')
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
                        <img src="{{ asset('storage/' . $destination->image) }}" class="card-img-top" alt="{{ $destination->name }}" />
                        <div class="card-body">
                            <h5 class="card-title">{{ $destination->name }}</h5>
                            <p class="card-text">Discount: {{ $destination->discount }}%</p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this destination?')">Delete</button>
                                </form>
                            </div>
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
                            <td>{{ $booking->date_time }}</td>
                            <td>{{ $booking->destination }}</td>
                            <td>{{ $booking->message }}</td>
                            <td>
                                <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this booking?')">Approve</button>
                                </form>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $bookings->links() }}
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
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount') }}" required>
                @error('discount')
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
                        <img src="{{ asset('storage/' . $destination->image) }}" class="card-img-top" alt="{{ $destination->name }}" />
                        <div class="card-body">
                            <h5 class="card-title">{{ $destination->name }}</h5>
                            <p class="card-text">Discount: {{ $destination->discount }}%</p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this destination?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $destinations->links() }}
        </div>
    </div>

    <!-- Target Section -->
    <div id="target" class="dashboard-container section">
        <h2>Target Packages</h2>
        <h4 class="mt-4 mb-3">Add New Package</h4>
        <form action="{{ route('packages.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration') }}" required>
                @error('duration')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="max_people" class="form-label">Max People</label>
                <input type="number" class="form-control" id="max_people" name="max_people" value="{{ old('max_people') }}" required>
                @error('max_people')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price') }}" required>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" class="form-control" id="rating" name="rating" step="0.1" min="0" max="5" value="{{ old('rating') }}" required>
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Package</button>
        </form>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr>
                            <td>{{ $package->name }}</td>
                            <td>{{ $package->title }}</td>
                            <td>{{ $package->location }}</td>
                            <td>{{ $package->duration }}</td>
                            <td>{{ $package->max_people }}</td>
                            <td>${{ number_format($package->price, 2) }}</td>
                            <td>{{ $package->rating }}</td>
                            <td>
                                <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('packages.destroy', $package->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this package?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $packages->links() }}
        </div>
    </div>
@endsection