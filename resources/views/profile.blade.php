
@extends('layouts.app')

@section('title', 'User Profile | Travel Explorer')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/@preline/preline@2.0.0/dist/preline.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
@endsection

@section('content')
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
                         style="background-image: url('{{ $user->avatar_url ?? asset('images/default-avatar.jpg') }}');"
                    ></div>
                    <form id="avatarForm" action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="avatarInput" name="avatar" accept="image/jpeg, image/png" />
                    </form>
                </div>

                <!-- User Info -->
                <div class="user-info">
                    <h2 id="userName">{{ $user->name }}</h2>
                    <p id="userEmail">{{ $user->email }}</p>
                    <p>Member since: <span id="memberSince">{{ $user->created_at->format('F Y') }}</span></p>
                </div>

                <!-- Edit Profile Button -->
                <button id="editProfileBtn" class="edit-profile-btn">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <nav class="custom-tabs-nav">
            <button class="tab-btn active" data-tab="profile">
                <i class="fas fa-user"></i> Profile
            </button>
            <button class="tab-btn" data-tab="bookings">
                <i class="fas fa-calendar-alt"></i> Bookings
            </button>
            <button class="tab-btn" data-tab="testimonials">
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
                    <div class="info-group">
                        <span class="info-label">Phone Number</span>
                        <p class="info-value" id="profilePhone">{{ $user->phone ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Edit Profile Form (Hidden by default) -->
                <div id="editProfileForm" style="display: none;">
                    <h3 class="section-title">Edit Profile</h3>
                    <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="editName" class="form-label">Full Name</label>
                            <input type="text" id="editName" name="name" class="form-input"
                                   value="{{ old('name', $user->name) }}" required />
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editEmail" class="form-label">Email Address</label>
                            <input type="email" id="editEmail" name="email" class="form-input"
                                   value="{{ old('email', $user->email) }}" required />
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editPhone" class="form-label">Phone Number</label>
                            <input type="tel" id="editPhone" name="phone" class="form-input"
                                   value="{{ old('phone', $user->phone) }}" />
                            @error('phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="button" id="cancelEditBtn" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>

                <!-- Password Change Section -->
                <div class="password-section">
                    <h3 class="section-title">Change Password</h3>
                    <form method="POST" action="{{ route('profile.password.change') }}">
                        @csrf
                        <div class="form-group">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" id="currentPassword" name="current_password" class="form-input" required />
                            @error('current_password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" id="newPassword" name="new_password" class="form-input" required />
                            @error('new_password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
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
            <h3 class="section-title">Your Booking History</h3>
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
                    <tbody id="bookingsTableBody">
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
                {{ $bookings->links() }}
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
            <!-- Add Testimonial Modal -->
            <div id="testimonialModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Testimonial</h3>
                        <button id="closeModalBtn" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form id="testimonialForm" method="POST" action="{{ route('testimonial.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="tourSelect" class="form-label">Select Tour</label>
                            <select id="tourSelect" name="tour_id" class="form-input" required>
                                <option value="" disabled selected>Choose a tour</option>
                                @foreach ($availableTours as $tour)
                                    <option value="{{ $tour->id }}">{{ $tour->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Rating</label>
                            <div class="rating-input">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }} />
                                    <label for="star{{ $i }}" title="{{ $i }} stars">★</label>
                                @endfor
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="testimonialText" class="form-label">Testimonial</label>
                            <textarea id="testimonialText" name="content" rows="4" class="form-input"
                                      placeholder="Write your testimonial here..." required></textarea>
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
            <p>© {{ date('Y') }} Travel Explorer. All rights reserved.</p>
            <div class="social-links">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>
</div>
@endsection

@section('scripts')
<script>
// Disable Preline's tab component
document.addEventListener('DOMContentLoaded', function() {
    if (window.HSStaticMethods) {
        window.HSStaticMethods.autoInit = function() {
            const components = ['collapse', 'dropdown', 'modal'];
            components.forEach(component => {
                if (window.HSStaticMethods.components[component]) {
                    window.HSStaticMethods.components[component].autoInit();
                }
            });
        };
        window.HSStaticMethods.autoInit();
    }
});

// CSRF Token Setup
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
if (!csrfToken) {
    console.error('CSRF token not found. Ensure <meta name="csrf-token"> is in the layout.');
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded');

    // Tab switching functionality
    function switchTab(tabId) {
        console.log(`Attempting to switch to tab: ${tabId}`);
        const tabButtons = document.querySelectorAll('.custom-tabs-nav .tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        if (tabButtons.length === 0 || tabContents.length === 0) {
            console.error('Tab elements missing:', {
                tabButtonsCount: tabButtons.length,
                tabContentsCount: tabContents.length
            });
            return;
        }

        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));

        const targetButton = document.querySelector(`.tab-btn[data-tab="${tabId}"]`);
        const targetContent = document.getElementById(tabId);

        if (targetButton && targetContent) {
            targetButton.classList.add('active');
            targetContent.classList.add('active');
            console.log(`Successfully switched to tab: ${tabId}`);
        } else {
            console.error('Tab button or content not found:', {
                tabId,
                targetButtonExists: !!targetButton,
                targetContentExists: !!targetContent
            });
        }
    }

    // Attach event listeners to tab buttons
    const tabButtons = document.querySelectorAll('.custom-tabs-nav .tab-btn');
    console.log(`Found ${tabButtons.length} tab buttons`);

    function handleTabClick(e) {
        e.preventDefault();
        const tabId = e.currentTarget.getAttribute('data-tab');
        console.log(`Tab button clicked: ${tabId}`);
        switchTab(tabId);
    }

    tabButtons.forEach(btn => {
        btn.removeEventListener('click', handleTabClick);
        btn.addEventListener('click', handleTabClick);
    });

    // Set initial active tab
    if (document.querySelector('.tab-btn[data-tab="profile"]')) {
        switchTab('profile');
    } else {
        console.warn('Profile tab button not found on initial load');
    }

    // Toast notification function
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast show ${type}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    // Edit profile toggle
    const editProfileBtn = document.getElementById('editProfileBtn');
    const editProfileForm = document.getElementById('editProfileForm');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const profileInfoDisplay = document.querySelector('.profile-grid > div:first-child');

    if (editProfileBtn && editProfileForm && cancelEditBtn && profileInfoDisplay) {
        editProfileBtn.addEventListener('click', () => {
            console.log('Edit profile button clicked');
            profileInfoDisplay.style.display = 'none';
            editProfileForm.style.display = 'block';
        });

        cancelEditBtn.addEventListener('click', () => {
            console.log('Cancel edit button clicked');
            editProfileForm.style.display = 'none';
            profileInfoDisplay.style.display = 'block';
            document.getElementById('profileForm').reset();
        });

        @if ($errors->hasAny(['name', 'email', 'phone']))
            editProfileBtn.click();
        @endif
    } else {
        console.warn('Profile edit elements missing:', { editProfileBtn, editProfileForm, cancelEditBtn, profileInfoDisplay });
    }

    // Avatar upload preview and submit
    const avatarInput = document.getElementById('avatarInput');
    const avatarForm = document.getElementById('avatarForm');
    if (avatarInput && avatarForm) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('avatarPreview').style.backgroundImage = `url(${event.target.result})`;
                    avatarForm.submit();
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        console.warn('Avatar upload elements missing:', { avatarInput, avatarForm });
    }

    // Testimonial modal handling
    const addTestimonialBtn = document.getElementById('addTestimonialBtn');
    const testimonialModal = document.getElementById('testimonialModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const testimonialForm = document.getElementById('testimonialForm');

    function closeTestimonialModal() {
        if (testimonialModal) {
            testimonialModal.style.display = 'none';
            document.body.style.overflow = '';
        }
        if (testimonialForm) {
            testimonialForm.reset();
            document.getElementById('star5').checked = true;
            testimonialForm.action = "{{ route('testimonial.store') }}";
            const methodInput = testimonialForm.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.value = 'POST';
            }
            document.querySelector('.modal-title').textContent = 'Add Testimonial';
        }
    }

    if (addTestimonialBtn && testimonialModal && testimonialForm) {
        addTestimonialBtn.addEventListener('click', () => {
            console.log('Add testimonial button clicked');
            testimonialModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });

        closeModalBtn.addEventListener('click', closeTestimonialModal);
        cancelModalBtn.addEventListener('click', closeTestimonialModal);

        window.addEventListener('click', (e) => {
            if (e.target === testimonialModal) {
                closeTestimonialModal();
            }
        });

        testimonialForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const tourSelect = this.querySelector('#tourSelect').value;
            const testimonialText = this.querySelector('#testimonialText').value.trim();
            if (!tourSelect || !testimonialText) {
                showToast('Please select a tour and enter a testimonial.', 'error');
                return;
            }

            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            const formData = new FormData(this);
            const isEdit = this.action.includes('/testimonials/') && formData.get('_method') === 'PUT';

            fetch(this.action, {
                method: isEdit ? 'PUT' : 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Testimonial form response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Testimonial form response data:', data);
                submitButton.disabled = false;
                if (data.success && data.testimonial) {
                    showToast(isEdit ? 'Testimonial updated successfully' : 'Testimonial added successfully', 'success');
                    const testimonialsList = document.getElementById('testimonialsList');
                    const noTestimonialsMessage = document.getElementById('noTestimonialsMessage');
                    if (noTestimonialsMessage) noTestimonialsMessage.remove();

                    const testimonialCard = document.createElement('div');
                    testimonialCard.className = 'testimonial-card';
                    testimonialCard.innerHTML = `
                        <div class="testimonial-header">
                            <h4>${data.testimonial.tour_name || 'Unknown Tour'}</h4>
                            <div class="rating">
                                ${'<i class="fas fa-star"></i>'.repeat(data.testimonial.rating || 0)}
                                ${'<i class="far fa-star"></i>'.repeat(5 - (data.testimonial.rating || 0))}
                            </div>
                        </div>
                        <p class="testimonial-text">${data.testimonial.content || ''}</p>
                        <div class="testimonial-footer">
                            <span>${new Date(data.testimonial.created_at || Date.now()).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</span>
                            <div class="testimonial-actions">
                                <button class="btn-edit" data-testimonial-id="${data.testimonial.id}">Edit</button>
                                <button class="btn-delete" data-testimonial-id="${data.testimonial.id}">Delete</button>
                            </div>
                        </div>`;

                    if (isEdit) {
                        const oldCard = document.querySelector(`.btn-edit[data-testimonial-id="${data.testimonial.id}"]`)?.closest('.testimonial-card');
                        if (oldCard) oldCard.replaceWith(testimonialCard);
                    } else {
                        testimonialsList.prepend(testimonialCard);
                    }

                    closeTestimonialModal();
                    attachTestimonialEventListeners();
                } else {
                    showToast(data.message || (isEdit ? 'Failed to update testimonial' : 'Failed to add testimonial'), 'error');
                }
            })
            .catch(error => {
                submitButton.disabled = false;
                showToast('An error occurred while processing the testimonial', 'error');
                console.error('Testimonial form error:', error);
            });
        });
    } else {
        console.warn('Testimonial elements missing:', { addTestimonialBtn, testimonialModal, testimonialForm });
    }

    // Booking actions
    function attachBookingEventListeners() {
        document.querySelectorAll('.btn-view').forEach(button => {
            button.removeEventListener('click', viewBookingHandler);
            button.addEventListener('click', viewBookingHandler);
        });

        document.querySelectorAll('.btn-cancel').forEach(button => {
            button.removeEventListener('click', cancelBookingHandler);
            button.addEventListener('click', cancelBookingHandler);
        });
    }

    function viewBookingHandler() {
        const bookingId = this.dataset.bookingId;
        this.disabled = true;
        fetch(`/bookings/${bookingId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('View booking response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('View booking response data:', data);
            this.disabled = false;
            if (data.success && data.booking) {
                showToast(`Booking ${bookingId}: ${data.booking.tour_name} on ${new Date(data.booking.travel_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}`, 'success');
            } else {
                showToast(data.message || 'Failed to load booking details', 'error');
            }
        })
        .catch(error => {
            this.disabled = false;
            showToast('An error occurred while loading booking details', 'error');
            console.error('View booking error:', error);
        });
    }

    function cancelBookingHandler() {
        if (confirm('Are you sure you want to cancel this booking?')) {
            const bookingId = this.dataset.bookingId;
            this.disabled = true;
            fetch(`/bookings/${bookingId}/cancel`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Cancel booking response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Cancel booking response data:', data);
                if (data.success) {
                    showToast('Booking cancelled successfully', 'success');
                    const row = this.closest('tr');
                    const statusCell = row.querySelector('.status-badge');
                    if (statusCell) {
                        statusCell.textContent = 'Cancelled';
                        statusCell.className = 'status-badge cancelled';
                    }
                    this.remove();
                    if (document.querySelectorAll('#bookingsTableBody tr').length === 0) {
                        document.getElementById('bookingsTableBody').innerHTML = `
                            <tr><td colspan="7" class="text-center">No bookings found</td></tr>`;
                    }
                } else {
                    this.disabled = false;
                    showToast(data.message || 'Failed to cancel booking', 'error');
                }
            })
            .catch(error => {
                this.disabled = false;
                showToast('An error occurred while cancelling the booking', 'error');
                console.error('Cancel booking error:', error);
            });
        }
    }

    // Testimonial actions
    function attachTestimonialEventListeners() {
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.removeEventListener('click', editTestimonialHandler);
            button.addEventListener('click', editTestimonialHandler);
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.removeEventListener('click', deleteTestimonialHandler);
            button.addEventListener('click', deleteTestimonialHandler);
        });
    }

    function editTestimonialHandler() {
        const testimonialId = this.dataset.testimonialId;
        this.disabled = true;
        fetch(`/testimonials/${testimonialId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('Edit testimonial response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Edit testimonial response data:', data);
            this.disabled = false;
            if (data.success && data.testimonial) {
                testimonialForm.action = `/testimonials/${testimonialId}`;
                let methodInput = testimonialForm.querySelector('input[name="_method"]');
                if (!methodInput) {
                    methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    testimonialForm.appendChild(methodInput);
                }
                methodInput.value = 'PUT';
                const tourSelect = testimonialForm.querySelector('#tourSelect');
                tourSelect.value = data.testimonial.tour_id || '';
                if (!tourSelect.value) {
                    console.warn('Tour ID not found in response, defaulting to first option');
                    tourSelect.selectedIndex = 0;
                }
                testimonialForm.querySelector(`#star${data.testimonial.rating || 5}`).checked = true;
                testimonialForm.querySelector('#testimonialText').value = data.testimonial.content || '';
                document.querySelector('.modal-title').textContent = 'Edit Testimonial';
                testimonialModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            } else {
                showToast(data.message || 'Failed to load testimonial', 'error');
            }
        })
        .catch(error => {
            this.disabled = false;
            showToast('An error occurred while loading the testimonial', 'error');
            console.error('Edit testimonial error:', error);
        });
    }

    function deleteTestimonialHandler() {
        if (confirm('Are you sure you want to delete this testimonial?')) {
            const testimonialId = this.dataset.testimonialId;
            this.disabled = true;
            fetch(`/testimonials/${testimonialId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Delete testimonial response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Delete testimonial response data:', data);
                if (data.success) {
                    showToast('Testimonial deleted successfully', 'success');
                    const card = this.closest('.testimonial-card');
                    if (card) card.remove();
                    if (document.querySelectorAll('.testimonial-card').length === 0) {
                        document.getElementById('testimonialsList').innerHTML = `
                            <div class="empty-state" id="noTestimonialsMessage">
                                You haven't submitted any testimonials yet.
                            </div>`;
                    }
                } else {
                    this.disabled = false;
                    showToast(data.message || 'Failed to delete testimonial', 'error');
                }
            })
            .catch(error => {
                this.disabled = false;
                showToast('An error occurred while deleting the testimonial', 'error');
                console.error('Delete testimonial error:', error);
            });
        }
    }

    // Attach event listeners initially
    attachBookingEventListeners();
    attachTestimonialEventListeners();

    // Dark Mode Toggle
    const themeToggle = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme') || 'light-mode';
    document.body.classList.add(currentTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            console.log('Theme toggle clicked');
            let newTheme;
            if (document.body.classList.contains('dark-mode')) {
                document.body.classList.remove('dark-mode');
                document.body.classList.add('light-mode');
                newTheme = 'light-mode';
            } else {
                document.body.classList.remove('light-mode');
                document.body.classList.add('dark-mode');
                newTheme = 'dark-mode';
            }
            localStorage.setItem('theme', newTheme);
        });
    } else {
        console.warn('Theme toggle button missing.');
    }

    // Handle session messages
    @if(session('success'))
        showToast(@json(session('success')), 'success');
    @endif
    @if(session('error'))
        showToast(@json(session('error')), 'error');
    @endif
});
</script>
@endsection

