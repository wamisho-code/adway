@if($bookings->count() > 0)
    <div class="booking-grid">
        @foreach($bookings as $booking)
            <div class="booking-card">
                <div class="booking-header">
                    <strong>Booking with id:{{ $booking->id }}</strong>
                    <span class="status {{ $booking->admin_approval }}">{{ ucfirst($booking->admin_approval) }}</span>
                </div>

                <video controls>
                    <source src="{{$booking->video_path}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>

                <div class="info">
                    <p><strong>Billboard Name:</strong> {{ $booking->billboard->title }}</p>
                    <p><strong>Owner :</strong> {{ $booking->owner->name}}</p>
                    <p><strong>Owner Phone :</strong> {{ $booking->owner->phone}}</p>
                    <p><strong>Advertiser Name:</strong> {{ $booking->Advertiser->name }}</p>
                    <p><strong>Advertiser Phone:</strong> {{ $booking->advertiser->phone }}</p>
                    <p><strong>Billboard location:</strong> {{ $booking->billboard->location }}</p>
                    <p><strong>Start:</strong> {{ $booking->start_date->format('Y-m-d') }}</p>
                    <p><strong>End:</strong> {{ $booking->end_date->format('Y-m-d') }}</p>
                    <p><strong>Net Payment:</strong> ${{ number_format($booking->net_payment, 2) }}</p>
                    <p><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status) }}</p>
                </div>

                <div class="actions">
                    @if($booking->admin_approval != "approved")
                        <form action="{{route('approve', $booking->id)}}" method="POST">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-approve">
                                <i class="fas fa-check-circle"></i> Approve
                            </button>
                        </form>
                    @endif
                    @if($booking->admin_approval != "denied")
                        <form action="{{route('deny',$booking->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-deny">
                                <i class="fas fa-times-circle"></i> Deny
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div style="margin-top: 2rem;">
        {{ $bookings->links() }}
    </div>
@else
    <p>No bookings found in this category.</p>
@endif