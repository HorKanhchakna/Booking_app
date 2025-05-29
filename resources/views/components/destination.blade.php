<!-- Destination Start -->
<div class="container-xxl py-5 destination">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Destination</h6>
            <h1 class="mb-5">Popular Destinations Near Phuket</h1>
        </div>
        <div class="row g-3">
            @if(isset($destinations))
                @foreach($destinations as $destination)
                    <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="#">
                            <img class="img-fluid" src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}">
                            <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">{{ $destination->discount }}% OFF</div>
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">{{ $destination->name }}</div>
                        </a>
                    </div>
                @endforeach

                @if(isset($destinations[3]))
                    <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                        <a class="position-relative d-block h-100 overflow-hidden" href="#">
                            <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('img/' . $destinations[3]->image) }}" alt="{{ $destinations[3]->country }}" style="object-fit: cover;">
                            <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">{{ $destinations[3]->discount }}</div>
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">{{ $destinations[3]->country }}</div>
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
<!-- Destination End -->
