<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | Travel Explorer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">

</head>
<body class="light-mode">
    <div class="container">
        <!-- Header -->
        <header>
            <h1>Travel Explorer</h1>
            <button id="theme-toggle" class="theme-toggle">
                <i class="fas fa-moon"></i>
                <i class="fas fa-sun"></i>
            </button>
        </header>

        <!-- Main Content -->
        <main class="main-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-header-content">
                    <!-- Avatar Upload -->
                    <div class="avatar-upload">
                        <div class="avatar-preview" id="avatarPreview"
                             style="background-image: url('{{ asset('images/default-avatar.jpg') }}');"
                        ></div>
                        <form id="avatarForm" action="#" method="POST" enctype="multipart/form-data">
                            <input type="file" id="avatarInput" name="avatar" accept="image/jpeg,image/png" />
                        </form>
                    </div>

                    <!-- User Info -->
                    <div class="user-info">
                    <h2 id="userName">{{ $user->name }}</h2>
                    <p id="userEmail">{{ $user->email }}</p>
                    <p>Member since: <span id="memberSince">{{ $user->created_at->format('F Y') }}</span></p>
                    </div>

                    <!-- Edit Profile Button -->
                    <button type="button" id="editProfileBtn" class="edit-profile-btn">
                        <i class="fas fa-edit"></i> Edit Profile
                    </button>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <nav class="custom-tabs-nav">
                <button type="button" class="tab-btn active" data-tab="profile">
                    <i class="fas fa-user"></i> Profile
                </button>
                <button type="button" class="tab-btn" data-tab="bookings">
                    <i class="fas fa-calendar-alt"></i> Bookings
                </button>
                <button type="button" class="tab-btn" data-tab="testimonials">
                    <i class="fas fa-star"></i> Testimonials
                </button>
            </nav>

            <!-- Tab Contents -->
            <div class="tab-content active" id="profile">
            <div class="profile-grid">
                <!-- Personal Information -->
                <div>
                    <h3 class="section-title">Personal Information</h3>
                    <div class="info-group">
                        <span class="info-label">Full Name</span>
                        <p class="info-value" id="profileName">{{ $user->name }}</p>
                    </div>
                    <div class="info-group">
                        <span class="info-label">Email Address</span>
                        <p class="info-value" id="profileEmail">{{ $user->email }}</p>
                    </div>
                </div>

                    <!-- Edit Profile Form -->
                    <div id="editProfileForm" style="display: none;">
                        <h3 class="section-title">Edit Profile</h3>
                        <form id="profileForm" method="POST" action="#">
                            <div class="form-group">
                                <label for="editName" class="form-label">Full Name</label>
                                <input type="text" id="editName" name="name" class="form-input"
                                       value="John Doe" required />
                            </div>
                            <div class="form-group">
                                <label for="editEmail" class="form-label">Email Address</label>
                                <input type="email" id="editEmail" name="email" class="form-input"
                                       value="john.doe@example.com" required />
                            </div>
                            <div class="form-group">
                                <label for="editPhone" class="form-label">Phone Number</label>
                                <input type="tel" id="editPhone" name="phone" class="form-input"
                                       value="+1 (555) 123-4567" />
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" id="cancelEditBtn" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <!-- Password Change -->
                    <div class="password-section">
                        <h3 class="section-title">Change Password</h3>
                        <form method="POST" action="#">
                            <div class="form-group">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <input type="password" id="currentPassword" name="current_password" class="form-input" required />
                            </div>
                            <div class="form-group">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" id="newPassword" name="new_password" class="form-input" required />
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                <input type="password" id="confirmPassword" name="new_password_confirmation" class="form-input" required />
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Bookings Tab -->
            <div class="tab-content" id="bookings">
                <h3 class="section-title">Your Bookings</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Tour Name</th>
                                <th>Booking Date</th>
                                <th>Travel Date</th>
                                <th>People</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="history">
                            @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->tour->name }}</td>
                            <td>{{ $booking->created_at->format('M d, Y') }}</td>
                            <td>{{ $booking->travel_date->format('M d, Y') }}</td>
                            <td>{{ $booking->number_of_people }}</td>
                            <td>${{ number_format($booking->total_price, 2) }}</td>
                            <td>
                                <span class="status-badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                            </td>
                            <td>
                                <button class="btn-view" data-booking-id="{{ $booking->id }}">View</button>
                                @if($booking->status === 'pending')
                                <button class="btn-cancel" data-booking-id="{{ $booking->id }}">Cancel</button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No bookings found</td>
                        </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Testimonials Tab -->
            <div class="tab-content" id="testimonials">
            <div class="testimonials-header">
                <h3 class="section-title">Your Testimonials</h3>
                <button id="addTestimonialBtn" class="add-testimonial-btn">
                    <i class="fas fa-plus"></i> Add Testimonial
                </button>
            </div>
            <div class="testimonials-grid" id="testimonialsList">
                @forelse($testimonials as $testimonial)
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <h4>{{ $testimonial->tour->name }}</h4>
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <p class="testimonial-text">{{ $testimonial->content }}</p>
                    <div class="testimonial-footer">
                        <span>{{ $testimonial->created_at->format('M d, Y') }}</span>
                        <div class="testimonial-actions">
                            <button class="btn-edit" data-testimonial-id="{{ $testimonial->id }}">Edit</button>
                            <button class="btn-delete" data-testimonial-id="{{ $testimonial->id }}">Delete</button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state" id="noTestimonialsMessage">
                    You haven't submitted any testimonials yet.
                </div>
                @endforelse
            </div>
                <!-- Testimonial Modal -->
                <div id="testimonialModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Add Testimonial</h3>
                            <button type="button" id="closeModalBtn" class="modal-close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <form id="testimonialForm" method="POST" action="#">
                            <div class="form-group">
                                <label for="tourSelect" class="form-label">Select Tour</label>
                                <select id="tourSelect" name="tour_id" class="form-input" required>
                                    <option value="" disabled selected>Choose a tour</option>
                                    <option value="1">Paris Adventure</option>
                                    <option value="2">Italian Getaway</option>
                                    <option value="3">Japanese Cultural Tour</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Rating</label>
                                <div class="rating-input">
                                    <input type="radio" id="star5" name="rating" value="5" checked />
                                    <label for="star5" title="5 stars">★</label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label for="star4" title="4 stars">★</label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label for="star3" title="3 stars">★</label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label for="star2" title="2 stars">★</label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label for="star1" title="1 star">★</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="testimonialText" class="form-label">Testimonial</label>
                                <textarea id="testimonialText" name="content" rows="4" class="form-input"
                                          placeholder="Write your testimonial..." required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" id="cancelModalBtn" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <p>© 2023 Travel Explorer. All rights reserved.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </footer>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Tab Switching
        function switchTab(tabId) {
            const buttons = document.querySelectorAll('nav.custom-tabs-nav button.tab-btn');
            const contents = document.querySelectorAll('main.main-card div.tab-content');

            buttons.forEach(btn => btn.classList.remove('active'));
            contents.forEach(content => content.classList.remove('active'));

            const button = document.querySelector(`button.tab-btn[data-tab="${tabId}"]`);
            const content = document.getElementById(tabId);

            if (button && content) {
                button.classList.add('active');
                content.classList.add('active');
            }
        }

        // Tab Event Listeners
        const tabButtons = document.querySelectorAll('nav.custom-tabs-nav button.tab-btn');
        tabButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const tabId = btn.getAttribute('data-tab');
                switchTab(tabId);
            });
        });

        // Edit Profile
        const editProfileBtn = document.getElementById('editProfileBtn');
        const editProfileForm = document.getElementById('editProfileForm');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const profileInfo = document.querySelector('.profile-grid > div:first-child');

        if (editProfileBtn && editProfileForm && cancelEditBtn && profileInfo) {
            editProfileBtn.addEventListener('click', () => {
                profileInfo.style.display = 'none';
                editProfileForm.style.display = 'block';
            });
            cancelEditBtn.addEventListener('click', () => {
                profileInfo.style.display = 'block';
                editProfileForm.style.display = 'none';
                document.getElementById('profileForm').reset();
            });
        }

        // Avatar Upload
        const avatarInput = document.getElementById('avatarInput');
        if (avatarInput) {
            avatarInput.addEventListener('change', () => {
                const file = avatarInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        document.getElementById('avatarPreview').style.backgroundImage = `url(${e.target.result})`;
                        // Here you would typically submit the form via AJAX
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Testimonial Modal
        const addTestimonialBtn = document.getElementById('addTestimonialBtn');
        const testimonialModal = document.getElementById('testimonialModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        function closeModal() {
            if (testimonialModal) {
                testimonialModal.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        if (addTestimonialBtn && testimonialModal) {
            addTestimonialBtn.addEventListener('click', () => {
                testimonialModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
            closeModalBtn.addEventListener('click', closeModal);
            cancelModalBtn.addEventListener('click', closeModal);
            window.addEventListener('click', e => {
                if (e.target === testimonialModal) {
                    closeModal();
                }
            });
        }

        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        if (themeToggle) {
            // Check for saved theme preference
            const currentTheme = localStorage.getItem('theme') || 'light';
            if (currentTheme === 'dark') {
                document.body.classList.add('dark-mode');
            }

            themeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                const theme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
                localStorage.setItem('theme', theme);
            });
        }
    });
    </script>
</body>
</html>
