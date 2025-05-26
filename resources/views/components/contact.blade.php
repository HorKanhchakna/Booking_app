<!-- Contact Start -->
<div class="container-xxl py-5" id="contact">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
            <h1 class="mb-5">We're Here to Help</h1>
            <p class="w-75 mx-auto">Have questions about your Phuket adventure? Our local experts are ready to assist you.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <h5>Our Phuket Office</h5>
                <p class="mb-4">We're available 24/7 to help plan your perfect Thai getaway. Contact us via phone, email, or visit our office in Patong.</p>
                <div class="d-flex align-items-center mb-4">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                        <i class="fa fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Location</h5>
                        <p class="mb-0">123 Beach Road, Patong, Phuket 83150, Thailand</p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Call Us</h5>
                        <p class="mb-0">+66 76 123 4567 (Office)</p>
                        <p class="mb-0">+66 81 234 5678 (24/7 Hotline)</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Email Us</h5>
                        <p class="mb-0">info@phuketparadisetours.com</p>
                        <p class="mb-0">bookings@phuketparadisetours.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.308399284882!2d98.2958573153269!3d7.891899681463033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3050258c441f0531%3A0x399950d912a5c800!2sPatong%20Beach!5e0!3m2!1sen!2sth!4v1629876543210!5m2!1sen!2sth"
                    frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                    loading="lazy"></iframe>
            </div>
            <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <form action="/contact" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                                <label for="phone">Phone Number (Optional)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select" id="subject" name="subject">
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Tour Booking">Tour Booking</option>
                                    <option value="Custom Package">Custom Package Request</option>
                                    <option value="Feedback">Feedback</option>
                                </select>
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 100px" required></textarea>
                                <label for="message">Your Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">
                                <i class="fa fa-paper-plane me-2"></i> Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->