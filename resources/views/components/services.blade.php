<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
            <h1 class="mb-5">Our Services</h1>
        </div>
        <div class="row g-4">
            @foreach([
                ['icon' => 'fa-globe', 'title' => 'WorldWide Tours', 'description' => 'Explore amazing destinations across the globe with our expertly curated tour packages.'],
                ['icon' => 'fa-hotel', 'title' => 'Hotel Reservation', 'description' => 'Book comfortable and affordable accommodations tailored to your needs and preferences.'],
                ['icon' => 'fa-user', 'title' => 'Travel Guides', 'description' => 'Get to know each destination with the help of experienced and knowledgeable local guides.'],
                ['icon' => 'fa-cog', 'title' => 'Event Management', 'description' => 'Plan and execute your events seamlessly with our professional event management services.'],
            ] as $key => $service)
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="{{ 0.1 + $key * 0.2 }}s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x {{ $service['icon'] }} text-primary mb-4"></i>
                            <h5>{{ $service['title'] }}</h5>
                            <p>{{ $service['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Service End -->
