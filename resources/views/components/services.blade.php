@php use Illuminate\Support\Str; @endphp

<!-- Services Start -->
<div class="container-xxl py-5" id="services">
    <div class="container">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Our Services</h6>
            <h1 class="mb-3">Phuket Experiences</h1>
            <p class="w-75 mx-auto">Discover the best of Southern Thailand with our carefully curated services</p>
        </div>
        <div class="row g-4">
            @if(isset($services))
                @foreach($services as $key => $service)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 + ($key % 4) * 0.2 }}s">
                        <div class="service-item rounded pt-3 h-100 hover-shadow">
                            <div class="p-4 position-relative">
                                @if($service->badge)
                                    <span class="position-absolute top-0 end-0 mt-3 me-3 badge bg-primary">
                                        {{ $service->badge }}
                                    </span>
                                @endif
                                <div class="icon-box bg-light p-3 mb-4 rounded-circle d-inline-block">
                                    <i class="fa fa-2x {{ $service->icon }} text-primary"></i>
                                </div>
                                <h5 class="mb-3">{{ $service->title }}</h5>
                                <p class="mb-4">{{ $service->desc }}</p>
                                <a href="/services/{{ Str::slug($service->title) }}" class="btn btn-link px-0">
                                    Learn More <i class="fa fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="color: red;">$services is not defined!</div>
            @endif
        </div>
    </div>
</div>
<!-- Services End -->
