
<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
            <h1 class="mb-5">Our Services</h1>
        </div>
        <div class="row g-4">
            @foreach([
                ['icon' => 'fa-globe', 'title' => 'WorldWide Tours'],
                ['icon' => 'fa-hotel', 'title' => 'Hotel Reservation'],
                ['icon' => 'fa-user', 'title' => 'Travel Guides'],
                ['icon' => 'fa-cog', 'title' => 'Event Management'],
            ] as $key => $service)
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="{{ 0.1 + $key * 0.2 }}s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x {{ $service['icon'] }} text-primary mb-4"></i>
                            <h5>{{ $service['title'] }}</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Service End -->
