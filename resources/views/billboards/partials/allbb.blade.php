@include('partials.navbar')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Modern Billboard Listings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* Preserve your glass styles */
    .glass-card {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      border-radius: 1rem;
      /* rounded-xl */
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .glass-card:hover {
      transform: scale(1.02);
    }

    .glass-price {
      background: #d3e7f5;
      backdrop-filter: blur(6px);
      border-left: 4px solid #108fea;
      border-radius: 0.5rem;
      /* rounded-lg */
      padding: 0.75rem 1rem;
      /* px-4 py-3 */
      margin-top: 0.5rem;
      /* mt-2 */
      color: rgb(4, 53, 101);
      /* text-yellow-900 */
      font-size: 0.875rem;
      /* text-sm */
      line-height: 1.25rem;
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
      /* space-y-1 */
    }

    /* Body background gradient and text styles */
    body {
      min-height: 100vh;
      margin: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial,
        sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
      background:linear-gradient(135deg, #e0f2ff 0%, #ffffff 50%, #bae6fd 100%);
      color: #1f2937;
      /* text-gray-800 */
    }

    /* Container max width and padding */
    .container {
      max-width: 80rem;
      /* 7xl: 1280px */
      margin-left: auto;
      margin-right: auto;
      padding-left: 1rem;
      /* px-4 */
      padding-right: 1rem;
      padding-top: 2.5rem;
      /* py-10 */
      padding-bottom: 2.5rem;
    }

    /* Title */
    h1 {
      font-weight: 800;
      /* font-extrabold */
      font-size: 2.25rem;
      /* text-4xl */
      color: #111827;
      /* text-gray-900 */
      margin-bottom: 1rem;
      /* mb-4 */
      line-height: 1.2;
    }

    h1 span {
      color: #2563eb;
      /* text-blue-600 */
    }

    /* Form styling */
    form {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      /* gap-4 */
    }

    .search-container {
      position: relative;
      flex-grow: 1;
      min-width: 250px;
    }

    input[type="search"] {
      width: 100%;
      border-radius: 0.5rem;
      /* rounded-lg */
      border: 1px solid #d1d5db;
      /* border-gray-300 */
      padding-left: 1rem;
      /* pl-4 */
      padding-right: 2.5rem;
      /* pr-10 */
      padding-top: 0.75rem;
      /* py-3 */
      padding-bottom: 0.75rem;
      box-shadow: 0 1px 2px rgb(0 0 0 / 0.05);
      /* shadow-sm */
      outline: none;
      font-size: 1rem;
      color: #111827;
      transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }

    input[type="search"]:focus {
      box-shadow: 0 0 0 2px #3b82f6;
      /* focus:ring-2 + ring-blue-500 */
      border-color: #3b82f6;
    }

    .search-container i {
      position: absolute;
      right: 0.75rem;
      /* right-3 */
      top: 0.875rem;
      /* top-3.5 */
      color: #9ca3af;
      /* text-gray-400 */
      pointer-events: none;
      font-size: 1rem;
    }

    select[name="filter"] {
      min-width: 180px;
      border-radius: 0.5rem;
      border: 1px solid #d1d5db;
      padding-left: 1rem;
      padding-right: 1rem;
      padding-top: 0.75rem;
      padding-bottom: 0.75rem;
      box-shadow: 0 1px 2px rgb(0 0 0 / 0.05);
      outline: none;
      font-size: 1rem;
      color: #111827;
      transition: box-shadow 0.2s ease, border-color 0.2s ease;
      background-color: white;
      appearance: none;
      background-image:
        url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%239ca3af' viewBox='0 0 20 20'%3e%3cpath d='M7 7l3-3 3 3H7z'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 0.75rem center;
      background-size: 1rem 1rem;
    }

    select[name="filter"]:focus {
      box-shadow: 0 0 0 2px #3b82f6;
      border-color: #3b82f6;
    }

    /* Grid for cards */
    .grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2rem;
      /* gap-8 */
    }

    @media (min-width: 640px) {
      .grid {
        grid-template-columns: repeat(2, 1fr);
        /* sm:grid-cols-2 */
      }
    }

    @media (min-width: 1024px) {
      .grid {
        grid-template-columns: repeat(3, 1fr);
        /* lg:grid-cols-3 */
      }
    }

    /* Card content padding and layout */
    .card-content {
      padding: 1.25rem;
      /* p-5 */
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      /* gap-3 */
    }

    h2 {
      font-size: 1.25rem;
      /* text-xl */
      font-weight: 600;
      /* font-semibold */
      margin: 0;
      color: #111827;
    }

    p.description {
      font-size: 0.875rem;
      /* text-sm */
      color: #4b5563;
      /* text-gray-600 */
      margin: 0;
    }

    p.location {
      font-size: 0.875rem;
      color: #374151;
      /* text-gray-700 */
      margin: 0;
      display: flex;
      align-items: center;
    }

    p.location i {
      margin-right: 0.25rem;
      /* mr-1 */
      color: #3b82f6;
      /* text-blue-500 */
      min-width: 1rem;
      text-align: center;
    }

    /* Price strong text */
    .glass-price strong {
      font-size: 21px;
      padding-left: 10px;
      font-weight: 700;
    }

    /* Status chip */
    .status-chip {
      margin-top: 0.5rem;
      /* mt-2 */
      display: inline-block;
      padding-left: 0.75rem;
      /* px-3 */
      padding-right: 0.75rem;
      padding-top: 0.25rem;
      /* py-1 */
      padding-bottom: 0.25rem;
      font-size: 0.75rem;
      /* text-xs */
      font-weight: 600;
      /* font-semibold */
      border-radius: 9999px;
      /* rounded-full */
      user-select: none;
    }

    .status-available {
      background-color: #d1fae5;
      /* bg-green-100 */
      color: #047857;
      /* text-green-700 */
    }

    .status-unavailable {
      background-color: #fee2e2;
      /* bg-red-100 */
      color: #b91c1c;
      /* text-red-700 */
    }

    /* Book Now button */
    .book-btn {
      margin-top: 1rem;
      /* mt-4 */
      display: inline-block;
      width: 100%;
      text-align: center;
      background-color: #2563eb;
      /* bg-blue-600 */
      color: white;
      font-weight: 600;
      padding: 0.5rem 0.75rem;
      /* py-2 */
      border-radius: 0.5rem;
      /* rounded-lg */
      text-decoration: none;
      transition: background-color 0.3s ease;
      user-select: none;
    }

    .book-btn:hover {
      background-color: #1e40af;
      /* hover:bg-blue-700 */
    }

    /* Posted date text */
    p.posted-date {
      font-size: 0.75rem;
      /* text-xs */
      color: #6b7280;
      /* text-gray-500 */
      margin-top: 0.5rem;
      /* mt-2 */
    }

    /* Pagination container */
    .pagination {
      margin-top: 2.5rem;
      /* mt-10 */
      display: flex;
      justify-content: center;
    }
  </style>
</head>

<body>

  <div class="container">
    <div style="margin-bottom: 2rem;">
      <h1> Browse <span>Billboards</span> in Ethiopia</h1>
    <form method="GET" action="{{ route('billboard.search') }}">
      <div class="search-container">
        <input type="search" name="search" placeholder="Search by title or location..." value="{{ request('search') }}">
        <i class="fas fa-search"></i>
      </div>
      <select name="filter">
        <option value="" {{ request('filter') == '' ? 'selected' : '' }}>All Status</option>
        <option value="available" {{ request('filter') == 'available' ? 'selected' : '' }}>Available</option>
        <option value="unavailable" {{ request('filter') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
      </select>
    </form>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('searchForm');
        const billboardList = document.getElementById('billboardlist');

        form.addEventListener('submit', function (e) {
          e.preventDefault();

          const formData = new FormData(form);
          const params = new URLSearchParams(formData).toString();

          fetch(`/billboards/search?${params}`, {
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
            .then(response => response.text())
            .then(html => {
              billboardList.innerHTML = html;
            })
            .catch(error => {
              console.error('Error:', error);
            });
        });

        // Optional: submit on select change too
        form.querySelector('select[name="filter"]').addEventListener('change', () => form.requestSubmit());
      });
    </script>


    </div>

    <div class="grid">
      <!-- Billboard Card -->
      @foreach($allbb as $billd)
      <div class="glass-card">
      <img src="{{ $billd->photo_path }}" alt="{{ $billd->title }}"
        style="width: 100%; height: 14rem; object-fit: cover;">

      <div class="card-content">
        <h2>{{ $billd->title }}</h2>
        <p class="description">{{ $billd->description }}</p>
        <p class="location"><i class="fas fa-map-marker-alt"></i> {{ $billd->location }}</p>

        <!-- Price Box -->
        <div class="glass-price">
        <div><i class="fas fa-calendar-day" style="margin-right: 0.25rem;"></i> Day:
          <strong>{{ number_format($billd->price_per_day, 2) }}</strong> birr
        </div>
        <div style="margin-top: 10px;"><i class="fas fa-calendar-alt" style="margin-right: 0.25rem;"></i> Month:
          <strong>{{ number_format($billd->price_per_month, 2) }}</strong> birr
        </div>
        </div>

        <!-- Status Chip -->
        <div class="mt-2">
        <span class="status-chip {{ $billd->status === 'available' ? 'status-available' : 'status-unavailable' }}">
          {{ ucfirst($billd->status) }}
        </span>
        </div>

        <!-- Book Now Button -->
        <a href="{{ route('booking.form', $billd->id) }}" class="book-btn">
        Book Now
        </a>

        <p class="posted-date">Posted: {{ $billd->created_at->format('d M, Y') }}</p>
      </div>
      </div>
    @endforeach
      <!-- End Billboard Card -->
    </div>

    <!-- Pagination -->
    <div class="pagination">
      {{ $allbb->links() }}
    </div>
  </div>
</body>

</html>
@include('footer')