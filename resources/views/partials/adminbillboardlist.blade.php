
    <div class="main">
        <h1>Billboards</h1>

        <div class="booking-grid">
            @foreach($billboards as $billboard)
                <div class="booking-card">
                    <div class="billboard-photo">
                        <img src="{{$billboard->photo_path}}" alt="Billboard Photo">
                    </div>
                    <div class="info">
                        <p><strong>Title:</strong> {{ $billboard->title }}</p>
                        <p><strong>Description:</strong> {{ $billboard->description }}</p>
                        <p><strong>Location:</strong> {{ $billboard->location }}</p>
                        <p><strong>Available From:</strong> {{ $billboard->available_from }}</p>
                        <p><strong>Available To:</strong> {{ $billboard->available_to }}</p>
                        <p><strong>Price/Day:</strong> {{ $billboard->price_per_day }} ETB</p>
                        <p><strong>Price/Month:</strong> {{ $billboard->price_per_month }} ETB</p>
                        <p><strong>Status:</strong> {{ ucfirst($billboard->status) }}</p>
                        <p><strong>Owner:</strong> {{ $billboard->owner->name ?? 'Unknown' }}</p>
                        <p><strong>Bookings:</strong> {{ $billboard->bookings_count }}</p>
                        <a href="" class="btn btn-deny" style="text-decoration: none"
                            onclick="return confirm('Are you sure you want to delete this billboard?')">
                            Delete
                        </a>
                    </div>
                </div>
            @endforeach

            <div style="margin-top: 2rem">
                {{ $billboards->links() }}
            </div>
        </div>
 </div>
{{-- 
{{ route('admin.delete-billboard', $billboard->id) }} --}}