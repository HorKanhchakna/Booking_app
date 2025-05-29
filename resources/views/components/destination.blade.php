<!-- Destination Start -->
<div class="container-xxl py-5 destination">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Destination</h6>
            <h1 class="mb-5">Popular Destination</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    @foreach($destinations as $index => $destination)
                        @if($index < 3)
                            <div class="col-lg-{{ $index == 0 ? 12 : 6 }} col-md-12 wow zoomIn" data-wow-delay="{{ 0.1 + ($index * 0.2) }}s">
                                <a class="position-relative d-block overflow-hidden" href="#">
                                    <img class="img-fluid" src="{{ asset($destination->image) }}" alt="{{ $destination->name }}">
                                    <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">
                                        {{ $destination->discount }}
                                    </div>
                                    <div class="position-absolute bottom-0 end-0 m-3 text-end">
                                        <div class="bg-white text-dark fw-bold py-1 px-2 mb-1">{{ $destination->name }}</div>
                                        <div class="bg-white text-primary fw-bold py-1 px-2">{{ $destination->country ?? '' }}</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            @if(count($destinations) > 3)
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" href="#">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{ asset($destinations[3]->image) }}" alt="{{ $destinations[3]->name }}" style="object-fit: cover;">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">
                            {{ $destinations[3]->discount }}
                        </div>
                        <div class="position-absolute bottom-0 end-0 m-3 text-end">
                            <div class="bg-white text-dark fw-bold py-1 px-2 mb-1">{{ $destinations[3]->name }}</div>
                            <div class="bg-white text-primary fw-bold py-1 px-2">{{ $destinations[3]->country ?? '' }}</div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Destination End -->
