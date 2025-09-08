<style>
    .billboard-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 30px;
        padding: 30px;
        background-color: #f3f4f6;
    }

    .billboard-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .billboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.12);
    }

    .billboard-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .billboard-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .billboard-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 8px;
    }

    .billboard-description {
        font-size: 1rem;
        color: #4a5568;
        margin-bottom: 16px;
        line-height: 1.5;
    }

    .billboard-info {
        font-size: 0.95rem;
        color: #2d3748;
        margin-bottom: 10px;
    }

    .price-info {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 10px;
    }

    .price-info span {
        background: #edf2f7;
        padding: 6px 14px;
        border-radius: 999px;
        font-weight: 500;
        font-size: 0.9rem;
        color: #2c5282;
    }

    .status {
        align-self: flex-start;
        background-color: #38a169;
        color: #fff;
        padding: 6px 16px;
        border-radius: 9999px;
        font-size: 0.85rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 10px;
    }

    .status.unavailable {
        background-color: #e53e3e;
    }

    /* Button styles */
    .billboard-actions {
        margin-top: 16px;
        display: flex;
        gap: 10px;
    }

    .billboard-btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    color: #333;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    display: inline-block;
    }

    /* On hover - subtle elevation */
    .billboard-btn:hover {
        background-color: #f0f0f0;
        border-color: #999;
    }

    /* Edit button specific */
    .edit-btn {
        border-color: #007bff55;
        background-color: #f3f7ff;
    }

    /* Delete button specific */
    .delete-btn {
        border-color: #e0b4b4;
        background-color: #fcf2f2;
        color: #a33;
    }

    .delete-btn:hover {
        background-color: #fbeaea;
        border-color: #d88;
    }

    /* Footer (Posted/Updated) */
    .billboard-footer {
        padding: 16px 20px;
        border-top: 1px solid #e2e8f0;
        font-size: 0.85rem;
        color: #718096;
        display: flex;
        gap: 20px;
        justify-content: flex-start;
        background-color: #f9fafb;
    }

    /* Pagination styling */
    .pagination {
        display: flex;
        justify-content: center;
        margin: 30px 0;
    }

    .pagination .page-link {
        padding: 8px 12px;
        margin: 0 5px;
        background-color: #edf2f7;
        border: none;
        border-radius: 6px;
        color: #2b6cb0;
        font-weight: 500;
        transition: all 0.2s;
    }

    .pagination .page-link:hover {
        background-color: #cbd5e0;
    }

    .pagination .active .page-link {
        background-color: #2b6cb0;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .billboard-container {
            grid-template-columns: 1fr;
            padding: 16px;
        }
    }
</style>


<div class="billboard-container">
    @foreach($billboards as $billboard)
        <div class="billboard-card">
            <img src="{{ $billboard->photo_path }}" alt="{{ $billboard->title }}" class="billboard-image">

            <div class="billboard-body">
                <div class="billboard-title">{{ $billboard->title }}</div>

                <div class="billboard-description">{{ $billboard->description }}</div>

                <div class="billboard-info"><strong>Location:</strong> {{ $billboard->location }}</div>

                <div class="price-info">
                    <span>Day: {{ number_format($billboard->price_per_day, 2) }} birr</span>
                    <span>Month: {{ number_format($billboard->price_per_month, 2) }} birr</span>
                </div>

                <div class="status {{ $billboard->status !== 'available' ? 'unavailable' : '' }}">
                    {{ ucfirst($billboard->status) }}
                </div>

                <!-- Buttons -->
                <div class="billboard-actions">
                    <a href="{{route('billboards.edit', $billboard->id)}}"  class="billboard-btn edit-btn">Edit</a>
                    <form method="POST" action="{{route('billboards.delete', $billboard->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="billboard-btn delete-btn">Delete</button>
                    </form>
                </div>
            </div>

            <div class="billboard-footer">
                <span><strong>Posted:</strong> {{ $billboard->created_at->format('M d, Y') }}</span>
                <span><strong>Updated:</strong> {{ $billboard->updated_at->format('M d, Y') }}</span>
            </div>
        </div>
    @endforeach
</div>

<div class="pagination">
    {{ $billboards->links() }}
</div>
  