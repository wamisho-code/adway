<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Bookings</title>
    <link rel="stylesheet" href="{{asset('cssfiles/admin.css')}}">
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


