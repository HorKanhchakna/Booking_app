<!-- Package Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
            <h1 class="mb-5">Awesome Packages</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($packages as $package)
            <div class="col-lg-4 col-md-6">
                <div class="package-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset($package->image) }}" alt="{{ $package->location }}">
                    </div>
                    <div class="d-flex border-bottom">
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $package->location }}
                        </small>
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-calendar-alt text-primary me-2"></i>{{ $package->duration }}
                        </small>
                        <small class="flex-fill text-center py-2">
                            <i class="fa fa-user text-primary me-2"></i>{{ $package->people }} Person
                        </small>
                    </div>
                    <div class="text-center p-4">
                        <h3 class="mb-0">${{ number_format($package->price, 2) }}</h3>
                        <div class="mb-3">
                            @for ($i = 0; $i < 5; $i++)
                                <small class="fa fa-star text-primary"></small>
                            @endfor
                        </div>
                        <p>{{ Str::limit($package->description, 100) }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <a href="javascript:void(0);"
                               class="btn btn-sm btn-primary px-3 border-end"
                               style="border-radius: 30px 0 0 30px;"
                               onclick="showPackageModal(
                                   '{{ $package->location }}',
                                   '{{ $package->duration }}',
                                   '{{ $package->people }}',
                                   '{{ number_format($package->price, 2) }}',
                                   `{{ $package->description }}`,
                                   '{{ asset($package->image) }}'
                               )">
                                Read More
                            </a>
                            <a href="{{ route('bookings.create', ['package_id' => $package->id]) }}"
                               class="btn btn-sm btn-primary px-3"
                               style="border-radius: 0 30px 30px 0;">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Package End -->


<!-- Package Detail Modal -->
<div id="packageModal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%); background:white; padding:20px; border-radius:8px; box-shadow:0 0 15px rgba(0,0,0,0.5); z-index:1050; max-width:500px; width:90%;">
    <h4 id="modalTitle" class="text-primary mb-3">Package Details</h4>
    <img id="modalImage" src="" alt="Package Image" style="width:100%; border-radius:8px; margin-bottom:10px;">
    <p><strong>Location:</strong> <span id="modalLocation"></span></p>
    <p><strong>Duration:</strong> <span id="modalDuration"></span></p>
    <p><strong>People:</strong> <span id="modalPeople"></span></p>
    <p><strong>Price:</strong> $<span id="modalPrice"></span></p>
    <p><strong>Description:</strong></p>
    <p id="modalDescription"></p>
    <button onclick="closePackageModal()" class="btn btn-secondary mt-3">Close</button>
</div>

<!-- Modal Overlay -->
<div id="modalOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:1040;" onclick="closePackageModal()"></div>


<!-- Modal JavaScript -->
<script>
    function showPackageModal(location, duration, people, price, description, imageUrl) {
        document.getElementById('modalLocation').innerText = location;
        document.getElementById('modalDuration').innerText = duration;
        document.getElementById('modalPeople').innerText = people;
        document.getElementById('modalPrice').innerText = price;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('modalImage').src = imageUrl;

        document.getElementById('packageModal').style.display = 'block';
        document.getElementById('modalOverlay').style.display = 'block';
    }

    function closePackageModal() {
        document.getElementById('packageModal').style.display = 'none';
        document.getElementById('modalOverlay').style.display = 'none';
    }
</script>
