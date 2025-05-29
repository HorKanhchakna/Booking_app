<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | Travel Explorer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    @push('styles')
<style>
    /* Basic CSS for the avatar upload component */
    .avatar-upload {
        position: relative;
        max-width: 150px; /* Adjust as needed */
        margin: 20px auto; /* Center it */
    }
    .avatar-preview {
        width: 150px; /* Same as max-width */
        height: 150px;
        border-radius: 50%; /* Makes it round */
        background-size: cover;
        background-position: center;
        background-color: #f0f0f0; /* Fallback color */
        border: 3px solid #ddd;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        overflow: hidden; /* Ensures image stays within bounds */
    }

    /* CRITICAL CSS: Hides the default file input */
    #avatarInput {
        display: none; /* This makes the input invisible and not interactable by default */
    }

    /* CSS for the clickable button (the label) */
    .upload-button {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #007bff; /* Primary button color */
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer; /* Changes cursor to pointer on hover */
        font-size: 1.2em;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        transition: background-color 0.3s ease;
    }
    .upload-button:hover {
        background-color: #0056b3;
    }
</style>
@endpush


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
                            style="background-image: url('{{ asset($user->profile_picture ? 'storage/' . $user->profile_picture : 'images/default-avatar.jpg') }}');"
                        ></div>
                        <form id="avatarForm" action="{{ route('user.profile_picture.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf {{-- Don't forget the CSRF token for Laravel forms --}}

                            <label for="avatarInput" class="upload-button">
                                <i class="fas fa-pencil-alt"></i> </label>

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
                        <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="editName" class="form-label">Full Name</label>
                                <input type="text" id="editName" name="name" class="form-input"
                                    value="{{ auth()->user()->name }}" required />
                            </div>
                            <div class="form-group">
                                <label for="editEmail" class="form-label">Email Address</label>
                                <input type="email" id="editEmail" name="email" class="form-input"
                                    value="{{ auth()->user()->email }}" required />
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" id="cancelEditBtn" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>


                    <!-- Password Change -->
                    {{-- <div class="password-section">
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
                    </div> --}}
                </div>
            </div>

            <!-- Bookings Tab -->
            <div class="tab-content" id="bookings">
                <h3 class="section-title">Your Bookings</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Package Name</th>
                                <th>Booking Date</th>
                                {{-- <th>Travel Date</th> --}}
                                <th>People</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="history">
                            @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->package ? $booking->package->location : 'N/A' }}</td>
                            <td>{{ $booking->created_at ? $booking->created_at->format('M d, Y') : 'N/A' }}</td>
                            {{-- <td>{{ $booking->travel_date ? \Carbon\Carbon::parse($booking->travel_date)->format('M d, Y') : 'N/A' }}</td> --}}

                            <td>{{ $booking->package->people }}</td>
                            <td>${{ number_format($booking->package->price, 2) }}</td>
                            <td>
                                <span class="status-badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                            </td>
                           <td>
                                <button class="btn-view" onclick="viewBooking({{ $booking->id }})">View</button>

                                @if($booking->status === 'pending')
                                    <button class="btn-cancel" onclick="cancelBooking({{ $booking->id }})">Cancel</button>
                                @endif
                            </td>

                        </tr>

                            <!-- Booking Details Modal -->
                            <div id="bookingModal" style="
                                display:none;
                                position:fixed;
                                top:15%;
                                left:50%;
                                transform:translateX(-50%);
                                width: 350px;
                                background: #ffffff;
                                padding: 25px 30px;
                                border-radius: 12px;
                                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
                                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                                color: #333;
                                z-index: 1000;
                            ">
                                <h3 style="margin-top:0; margin-bottom: 20px; color: #0056b3; font-weight: 700; font-size: 22px;">Booking Details</h3>

                                <p><strong>Name:</strong> <span id="modalName" style="color:#444;"></span></p>
                                <p><strong>Email:</strong> <span id="modalEmail" style="color:#444;"></span></p>
                                <p><strong>Package:</strong> <span id="modalPackage" style="color:#444;"></span></p>
                                <p><strong>Date:</strong> <span id="modalDate" style="color:#444;"></span></p>
                                <p><strong>Notes:</strong> <span id="modalNotes" style="color:#444; font-style: italic;"></span></p>

                                <button onclick="closeModal()" style="
                                    margin-top: 25px;
                                    background-color: #0056b3;
                                    color: white;
                                    border: none;
                                    padding: 10px 20px;
                                    border-radius: 6px;
                                    font-weight: 600;
                                    cursor: pointer;
                                    transition: background-color 0.3s ease;
                                "
                                onmouseover="this.style.backgroundColor='#003d80'"
                                onmouseout="this.style.backgroundColor='#0056b3'">
                                    Close
                                </button>
                            </div>

                            <!-- Modal overlay -->
                            <div id="modalOverlay" style="
                                display:none;
                                position:fixed;
                                top:0; left:0;
                                width:100%; height:100%;
                                background: rgba(0, 0, 0, 0.45);
                                z-index: 999;
                                backdrop-filter: blur(2px);
                                -webkit-backdrop-filter: blur(2px);
                            " onclick="closeModal()"></div>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No bookings found</td>
                        </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Testimonials Section -->
            <div class="tab-content" id="testimonials">
                <div class="testimonials-header">
                    <h3 class="section-title">Your Testimonials</h3>
                    <button id="addTestimonialBtn" class="add-testimonial-btn">
                        <i class="fas fa-plus"></i> Add Testimonial
                    </button>
                </div>

                <div class="testimonials-grid" id="testimonialsList">
                    @forelse(auth()->user()->testimonials as $testimonial)
                        <div class="testimonial-card">
                <div class="testimonial-header">
                    <h4>{{ $testimonial->package->location }}</h4>
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
                <!-- Correct field here -->
                <p class="testimonial-text">{{ $testimonial->review }}</p>
                <div class="testimonial-footer">
                    <span>{{ $testimonial->created_at->format('M d, Y') }}</span>
                    <div class="testimonial-actions">

                <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this testimonial?');">
                        Delete
                    </button>
                </form>
            </div>
                </div>
            </div>
                    @empty
                        <div class="empty-state" id="noTestimonialsMessage">
                            You haven't submitted any testimonials yet.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Testimonial Modal -->
            <div id="testimonialModal" class="modal" style="display:none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Testimonial</h3>
                        <button type="button" id="closeModalBtn" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="testimonialForm" method="POST" action="{{ route('testimonials.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="packageSelect" class="form-label">Select Package</label>
                            <select name="package_id" id="packageSelect" class="form-select" required>
                                <option value="" disabled {{ old('package_id') ? '' : 'selected' }}>Select a package</option>
                                @foreach (auth()->user()->bookedPackages as $package)
                                    <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                        {{ $package->location }}
                                    </option>
                                @endforeach
                            </select>
                            @error('package_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Rating</label>
                            <div class="rating-input">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                                        {{ old('rating', 5) == $i ? 'checked' : '' }} />
                                    <label for="star{{ $i }}" title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">★</label>
                                @endfor
                            </div>
                            @error('rating')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                      <div class="form-group">
                        <label for="testimonialText" class="form-label">Testimonial</label>
                        <textarea id="testimonialText" name="review" rows="4" class="form-input" placeholder="Write your testimonial..." required>{{ old('review') }}</textarea>
                        @error('review')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" id="cancelModalBtn" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
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
    document.getElementById('avatarInput').addEventListener('change', function() {
        document.getElementById('avatarForm').submit();
    });
   function viewBooking(bookingId) {
        fetch(`/bookings/${bookingId}`)
            .then(response => {
                if (!response.ok) throw new Error("Failed to fetch booking.");
                return response.json();
            })
            .then(data => {
                document.getElementById('modalName').textContent = data.name;
                document.getElementById('modalEmail').textContent = data.email;
                document.getElementById('modalPackage').textContent = data.package.location;
                document.getElementById('modalDate').textContent = data.booking_date;
                document.getElementById('modalNotes').textContent = data.notes || 'N/A';

                document.getElementById('bookingModal').style.display = 'block';
                document.getElementById('modalOverlay').style.display = 'block';
            })
            .catch(error => {
                console.error(error);
                alert("Could not load booking details.");
            });
    }

    function closeModal() {
        document.getElementById('bookingModal').style.display = 'none';
        document.getElementById('modalOverlay').style.display = 'none';
    }

    function cancelBooking(bookingId) {
        if (confirm("Are you sure you want to cancel this booking?")) {
            fetch(`/bookings/${bookingId}/cancel`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    alert("Booking cancelled successfully.");
                    location.reload(); // Refresh to update the table
                } else {
                    alert("Failed to cancel the booking.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred.");
            });
        }
    }

    function cancelBooking(bookingId) {
        if (confirm("Are you sure you want to cancel this booking?")) {
            fetch(`/bookings/${bookingId}/cancel`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    alert("Booking cancelled successfully.");
                    location.reload(); // Refresh page to show updated data
                } else {
                    alert("Failed to cancel the booking.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred.");
            });
        }
    }

document.addEventListener('DOMContentLoaded', () => {
    // --- Tab Switching ---
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

    const tabButtons = document.querySelectorAll('nav.custom-tabs-nav button.tab-btn');
    tabButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const tabId = btn.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // --- Edit Profile ---
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
            const profileForm = document.getElementById('profileForm');
            if (profileForm) profileForm.reset();
        });
    }

    // --- Avatar Upload ---
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');

    if (avatarInput && avatarPreview) {
        avatarInput.addEventListener('change', () => {
            const file = avatarInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    avatarPreview.style.backgroundImage = `url(${e.target.result})`;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // --- Testimonial Modal ---
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

        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', closeModal);
        }

        if (cancelModalBtn) {
            cancelModalBtn.addEventListener('click', closeModal);
        }

        window.addEventListener('click', (e) => {
            if (e.target === testimonialModal) {
                closeModal();
            }
        });
    }

    // --- Theme Toggle ---
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            document.body.classList.add('dark-mode');
        }

        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const newTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
            localStorage.setItem('theme', newTheme);
        });
    }
});

    </script>
</body>
</html>
