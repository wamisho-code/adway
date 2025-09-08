
<style>
/* Base & Fonts */
/* Base & Fonts */
body {
    font-family: 'Inter', sans-serif;
    background: #f5f7fa;
    color: #333;
    margin: 0;
    
}

/* Filter Form */
.filter-form {
    max-width: 1000px;
    margin: 0 auto 30px auto;
    padding: 15px 25px;
    background: linear-gradient(135deg, #d0f0fd 0%, #f0faff 100%);
    border-radius: 12px;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.07);
    display: flex;
    justify-content: flex-end;
}

.filter-form form {
    display: flex;
    align-items: center;
    gap: 12px;
}

.filter-form label {
    font-weight: 600;
    color: #0366d6;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-form label::before {
    content: "\f0b0"; /* filter icon */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    color: #0366d6;
}

.filter-form select {
    padding: 10px 18px;
    font-size: 15px;
    border: 2px solid #87ceeb;
    border-radius: 8px;
    background: white;
    color: #0366d6;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 160px;
}

.filter-form select:hover,
.filter-form select:focus {
    border-color: #0056b3;
    outline: none;
}

/* Booking Container */
.booking-container {
    max-width: 1000px;
    margin: 0 auto 60px auto;
}

.booking-container h2 {
    font-weight: 700;
    font-size: 32px;
    text-align: center;
    color: #0366d6;
    margin-bottom: 30px;
    position: relative;
}

.booking-container h2::after {
    content: "\f073"; /* calendar-alt icon */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    margin-left: 12px;
    color: #58a6ff;
}

/* Booking Card */
.booking-card {
    display: flex;
    flex-wrap: wrap;
    background: white;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(3, 102, 214, 0.12);
    margin-bottom: 25px;
    overflow: hidden;
    transition: box-shadow 0.25s ease;
}

.booking-card:hover {
    box-shadow: 0 15px 40px rgba(3, 102, 214, 0.2);
}

/* Video Preview */
.video-preview {
    flex: 1 1 520px;
    background-color: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    border-radius: 10px;
}

.video-player {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Fills container, crops excess */
    border-radius: 10px;
}


/* Updated Booking Info Text Style */
.booking-info {
    flex: 1.5 1 480px;
    padding: 28px 36px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: #444; /* softer dark gray */
    font-size: 16px;
    line-height: 1.6;
    font-weight: 400;
}

.booking-info p {
    margin: 12px 0;
}

.booking-info p strong {
    display: inline;
    font-weight: 600;
    color: #222; /* slightly darker for label */
    margin-right: 6px;
}

.booking-info p span.value {
    color: #0366d6;
    font-weight: 600;
}

/* Status badges */
.status {
    display: inline-block;
    padding: 6px 16px;
    font-weight: 700;
    font-size: 12px;
    border-radius: 24px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
}

.status.pending {
    background-color: #fff5e6;
    color: #d9822b;
}

.status.approved {
    background-color: #e6ffed;
    color: #22863a;
}

.status.rejected {
    background-color: #ffe6e6;
    color: #b31d1d;
}

/* Responsive */
@media (max-width: 768px) {
    .booking-card {
        flex-direction: column;
    }
    .video-preview {
        width: 100%;
        flex: none;
    }
    .booking-info {
        padding: 20px 25px;
        flex: none;
        width: 100%;
    }
    .filter-form {
        justify-content: center;
        padding: 15px 10px;
    }
    .filter-form form {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
        width: 100%;
        max-width: 320px;
    }
    .filter-form label,
    .filter-form select {
        width: 100%;
    }
}


</style>
    
@include('partials.navbar')    
    <div class="filter-form">
        <form method="GET" action="{{ route('bookings') }}">
            <label for="status">Filter by Status:</label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="">-- All --</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </form>
    </div>

    <div class="booking-container">
        <h2>Your Billboard Bookings</h2>

        @forelse($bookings as $booking)
            <div class="booking-card">
                <div class="video-preview">
                    <video class="video-player" controls preload="metadata" poster="">
                        <source src="{{ $booking->video_path }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                </div>
                <div class="booking-info">
                    <p><strong>Billboard Title:</strong> <span class="value">{{ $booking->billboard->title }}</span></p>
                    <p><strong>Advertiser Name:</strong> <span class="value">{{ $booking->advertiser->name }}</span></p>
                    <p><strong>Advertiser Phone:</strong> <span class="value">{{ $booking->advertiser->phone }}</span></p>
                    <p><strong>Billboard Location:</strong> <span class="value">{{ $booking->billboard->location }}</span></p>
                    <p><strong>Start Date:</strong> <span
                            class="value">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</span></p>
                    <p><strong>End Date:</strong> <span
                            class="value">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span></p>
                    <p><strong>Paid:</strong> <span class="value">{{ $booking->net_payment }} Birr</span></p>
                    <p><strong>Booked for:</strong> <span
                            class="value">{{ \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)) + 1 }}
                            day(s)</span></p>
                    <p><strong>Payment-Status:</strong>
                        <span class="status {{ strtolower($booking->payment_status) }}">
                            {{ ucfirst($booking->payment_status) }}
                        </span>
                    </p>
                   
                </div>
            </div>
        @empty
            <p>No bookings found.</p>
        @endforelse
    </div>
@include('footer')