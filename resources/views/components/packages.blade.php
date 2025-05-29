<!-- Package Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
            <h1 class="mb-5">Phuket Tour Packages</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach(App\Models\Tour::all() as $package)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('img/' . $package->image_path) }}" alt="{{ $package->title }}">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $package->location }}
                            </small>
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-calendar-alt text-primary me-2"></i>{{ $package->duration }}
                            </small>
                            <small class="flex-fill text-center py-2">
                                <i class="fa fa-user text-primary me-2"></i>{{ $package->max_people }}
                            </small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">฿{{ number_format($package->price, 0) }}</h3>
                            <div class="mb-3">
                                @php
                                    $fullStars = floor($package->rating);
                                    $halfStar = ($package->rating - $fullStars) >= 0.5;
                                @endphp

                                @for($i = 0; $i < $fullStars; $i++)
                                    <small class="fa fa-star text-primary"></small>
                                @endfor

                                @if($halfStar)
                                    <small class="fa fa-star-half-alt text-primary"></small>
                                @endif

                                @for($i = 0; $i < 5 - ceil($package->rating); $i++)
                                    <small class="far fa-star text-primary"></small>
                                @endfor

                                <small>({{ number_format($package->rating, 1) }})</small>
                            </div>
                            <p>{{ $package->description }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="#" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                <a href="#" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Package End -->
