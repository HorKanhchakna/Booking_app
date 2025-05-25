    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Company</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ url('/about') }}" class="text-white text-decoration-none">About Us</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ url('/contact') }}" class="text-white text-decoration-none">Contact Us</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ url('/packages') }}" class="text-white text-decoration-none">Privacy Policy</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ url('/destination') }}" class="text-white text-decoration-none">Terms &
                                Condition</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ url('/team') }}" class="text-white text-decoration-none">FAQs & Help</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, Phuket (Thailand)</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>chhornsreyproek@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/proek.juusa/"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.youtobe.com/"><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/package-1.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/package-2.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/package-3.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/package-2.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/package-3.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/package-1.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <a href="{{ route('register') }}">
                            <button type="button"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="{{ url('/') }}">Home</a>
                            <a href="#">Cookies</a>
                             <a href="{{ url('/services') }}">Help</a>
                            <a href="#">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
