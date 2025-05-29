 {{-- <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Clients Say!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('img/testimonial-1.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('img/testimonial-2.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mt-2 mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('img/testimonial-3.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mt-2 mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('img/testimonial-4.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mt-2 mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End --> --}}


    <!-- Testimonial Start -->
<!-- Testimonial Section Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
            <h1 class="mb-5">Our Clients Say!!!</h1>
        </div>

        <!-- Testimonial Content -->
        @if($testimonials->count() > 0)
            <div class="owl-carousel testimonial-carousel position-relative">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-item bg-white text-center border p-4">
                        <!-- User Image -->
                        @if($testimonial->user && $testimonial->user->profile_picture)
                            <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3"
                                src="{{ asset('storage/'.$testimonial->user->profile_picture) }}"
                                style="width: 80px; height: 80px;">
                        @else
                            <div class="bg-white rounded-circle shadow p-1 mx-auto mb-3 d-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; background-color: #f0f0f0;">
                                <i class="fas fa-user fa-2x text-primary"></i>
                            </div>
                        @endif

                        <!-- User Details -->
                        <h5 class="mb-0">{{ $testimonial->user ? $testimonial->user->name : 'Anonymous' }}</h5>
                        <p>{{ $testimonial->package ? $testimonial->package->location : 'No Package' }}</p>

                        <!-- Rating Stars -->
                        <div class="rating mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= ($testimonial->rating ?? 0))
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                        </div>

                        <!-- Review Text -->
                        <p class="mb-0">{{ $testimonial->review ?? 'No review content available' }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-4">
                <p class="text-muted">No testimonials available yet from booked clients.</p>
            </div>
        @endif
    </div>
</div>
<!-- Testimonial Section End -->
