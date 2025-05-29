<!-- Booking Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Booking</h6>
            <h1 class="mb-5">Online Booking</h1>
        </div>
        <div class="booking p-5 bg-primary rounded">
            <div class="row g-5 align-items-center">
                <div class="col-md-6 text-white">
                    <h6 class="text-white text-uppercase">Booking</h6>
                    <h1 class="text-white mb-4">Online Booking</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos.</p>
                    <p class="mb-4">Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <a class="btn btn-outline-light py-3 px-5 mt-2" href="#">Read More</a>
                </div>

                <div class="col-md-6">
                    <h1 class="text-white mb-4">Book A Tour</h1>

                    @auth
                        <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <!-- Display messages -->
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- User Info (Display Only) -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent text-white"
                                               value="{{ auth()->user()->name }}" disabled>
                                        <label>Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent text-white"
                                               value="{{ auth()->user()->email }}" disabled>
                                        <label>Your Email</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Fields -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="booking_date" class="form-control bg-transparent text-white"
                                               required value="{{ old('booking_date') }}"
                                               min="{{ date('Y-m-d') }}">
                                        <label for="booking_date">Booking Date</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-transparent text-white" name="package_id" required>
                                            <option value="">Choose Package</option>
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                                    {{ $package->location }} ({{ $package->duration }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="package_id">Destination</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="notes" class="form-control bg-transparent text-white"
                                                  placeholder="Special Request" style="height: 100px">{{ old('notes') }}</textarea>
                                        <label for="notes">Special Request</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-outline-light w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    @endauth

                    @guest
                        <div class="text-white bg-dark p-4 rounded">
                            <p class="mb-2">You need to log in to book a tour.</p>
                            <a href="{{ route('login') }}" class="btn btn-warning text-dark">Log in</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
