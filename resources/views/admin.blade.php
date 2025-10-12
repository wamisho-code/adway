<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Bookings</title>
    <link rel="stylesheet" href="{{asset('cssfiles/admin.css')}}">
    <style>
        :root {
    --primary: #2563eb;
    --success: #10b981;
    --danger: #ef4444;
    --bg: #f3f4f6;
    --card-bg: rgba(255, 255, 255, 0.75);
    --text-dark: #1f2937;
    --text-light: #6b7280;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: var(--bg);
    color: var(--text-dark);
    min-height: 100vh;
    display: flex;
}

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 240px;
    background-color: #1f2937;
    color: white;
    display: flex;
    flex-direction: column;
    padding: 1.5rem;
    gap: 1rem;
    flex-shrink: 0;
    z-index: 1000;
}

.sidebar h2 {
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
}

.sidebar a {
    color: #9ca3af;
    text-decoration: none;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    transition: background-color 0.3s;
}

.sidebar a:hover,
.sidebar a.active {
    background-color: var(--primary);
    color: white;
}

.content-wrapper {
    margin-left: 240px;
    flex: 1;
    display: flex;
    flex-direction: column;
    width: auto;
}

/* Top search/filter bar */
.top-bar {
    background-color: white;
    padding: 1rem 2rem;
    display: flex;
    gap: 1rem;
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
    flex-wrap: wrap;
}

.top-bar input[type="text"] {
    flex: 1 1 300px;
    padding: 0.6rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 1rem;
    min-width: 250px;
}

.top-bar select {
    flex: 0 1 200px;
    padding: 0.6rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 1rem;
    min-width: 150px;
}

.top-bar button {
    padding: 0.6rem 1.2rem;
    background-color: var(--primary);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: background-color 0.3s ease;
}

.top-bar button:hover {
    background-color: #1d4ed8;
}

.main {
    flex: 1;
    padding: 2rem;
}

h1 {
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    font-weight: bold;
}

/* Stack cards vertically, full width */
.booking-grid {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    /* space between cards */
}

/* Booking card styles */
.booking-card {
    background: var(--card-bg);
    border-radius: 12px;
    backdrop-filter: blur(6px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    transition: transform 0.2s ease;
    width: 100%;
    /* full width */
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
    flex-wrap: wrap;
}

.booking-card:hover {
    transform: scale(1.01);
}

/* Header inside card: id and status */
.booking-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    width: 100%;
}

.status {
    padding: 0.35rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
    white-space: nowrap;
}

.status.approved {
    background: #d1fae5;
    color: #065f46;
}

.status.pending {
    background: #fef3c7;
    color: #92400e;
}

.status.denied {
    background: #fee2e2;
    color: #991b1b;
}

/* Video side */
.booking-card video {
    flex: 0 0 300px;
    /* fixed width */
    max-height: 180px;
    border-radius: 8px;
    object-fit: cover;
}

/* Info side next to video */
.info {
    background-color: #ffffff;
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    margin-top: 0;
    /* align horizontally */
    flex: 1 1 auto;
    /* fill remaining space */
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem 1.5rem;
}

.info p {
    margin: 0;
    font-size: 0.95rem;
    color: #374151;
    line-height: 1.5;
    flex: 1 1 45%;
}

.info p strong {
    display: inline-block;
    width: 160px;
    color: #1f2937;
}

/* Actions buttons */
.actions {
    margin-top: 1rem;
    display: flex;
    gap: 0.7rem;
    flex-wrap: wrap;
    flex-basis: 100%;
    /* <-- THIS LINE is the fix */
}

.btn {
    padding: 0.55rem 1.2rem;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    color: white;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.btn-approve {
    background: linear-gradient(to right, #10b981, #059669);
}

.btn-approve:hover {
    background: linear-gradient(to right, #059669, #047857);
    transform: scale(1.05);
}

.btn-deny {
    background: linear-gradient(to right, #ef4444, #b91c1c);
}

.btn-deny:hover {
    background: linear-gradient(to right, #b91c1c, #7f1d1d);
    transform: scale(1.05);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .booking-card {
        flex-direction: column;
        padding: 1rem;
    }

    .booking-card video {
        width: 100%;
        max-height: none;
        margin-bottom: 1rem;
    }

    .info {
        flex-direction: column;
        margin-top: 1rem;
    }

    .info p {
        flex: 1 1 100%;
    }

    .sidebar {
        display: none;
    }

    .main {
        padding: 1rem;
    }
}

    </style>
</head>
<body>
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ route('admin') }}" class="{{ $status === 'pending' ? 'active' : '' }}">Pending</a>
        <a href="{{ route('get-approved') }}" class="{{ $status === 'approved' ? 'active' : '' }}">Approved</a>
        <a href="{{ route('get-denied') }}" class="{{ $status === 'denied' ? 'active' : '' }}">Denied</a>
        <a href="{{route('admin-owners')}}" class="{{ $status === 'owners' ? 'active' : '' }}">Owners</a>
        <a href="{{route('admin-advertisers')}}" class="{{ $status === 'advertisers' ? 'active' : '' }}">Advertisers</a>
        <a href="{{route('admin-billboards')}}" class="{{ $status === 'billboards' ? 'active' : '' }}">BillBoards</a>
        <a href="{{route('admin-stat')}}" class="{{ $status === 'stat' ? 'active' : '' }}">Statistics</a>
        <a href="{{route('home.user')}}">Home Page</a>
    </aside>

    <div class="content-wrapper">
        @if ($status != 'stat')
            
        <form method="GET" action="{{ 
                $status === 'approved' ? route('get-approved') :
        ($status === 'denied' ? route('get-denied') :
            ($status === 'owners' ? route('admin-owners') :
                ($status === 'advertisers' ? route('admin-advertisers') :
                    ($status === 'billboards' ? route('admin-billboards') : route('admin'))
                )
            )
        )
            }}" class="top-bar">
        <input type="text" name="query" placeholder="Search here..." value="{{ request('query') }}">
        
        @if(in_array($status, ['approved', 'denied', 'pending']))
            <select name="filter">
                <option value="">Filter By</option>
                <option value="billboard" {{ request('filter') == 'billboard' ? 'selected' : '' }}>Latest</option>
                <option value="owner" {{ request('filter') == 'owner' ? 'selected' : '' }}>Old</option>
                <option value="advertiser" {{ request('filter') == 'advertiser' ? 'selected' : '' }}>Price</option>
            </select>
        @elseif(in_array($status, ['owners', 'advertisers', 'billboards']))
            <select name="filter">
                <option value="">-- Sort --</option>
                <option value="latest" {{ request('filter') == 'latest' ? 'selected' : '' }}>Latest</option>
                <option value="old" {{ request('filter') == 'old' ? 'selected' : '' }}>Oldest</option>
            </select>
        @endif

        <button type="submit">
            <i class="fas fa-search"></i> Search
        </button>
    </form>
    @endif
    <main class="main">
            
            @include('partials.status')
            @if($status == 'approved' || $status == 'denied' || $status == 'pending')
                <h1>Bookings – {{ $status }}</h1>
                @include('partials.adminlist')
            @elseif($status == "owners" || $status == "advertisers")
                @include('partials.userslist')
            @elseif($status == "billboards")
                @include('partials.adminbillboardlist')
            @elseif($status == 'stat')
                @include('partials.adminstat')
            @endif

        </main>
    </div>
</body>
</html>


