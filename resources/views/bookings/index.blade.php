
<h1>My Bookings</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($bookings->isEmpty())
    <p>You have no bookings yet.</p>
@else
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Package</th>
            <th>Number of People</th>
            <th>Booking Date</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->package->name ?? 'N/A' }}</td>
            <td>{{ $booking->number_of_people }}</td>
            <td>{{ $booking->booking_date }}</td>
            <td>${{ number_format($booking->total_price, 2) }}</td>
            <td>{{ ucfirst($booking->status) }}</td>
            <td>{{ $booking->notes }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif


