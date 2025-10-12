<link rel="stylesheet" href="{{ asset('cssfiles/home.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

<header>
    <nav id="mainNav">
        <!-- Left: Logo + Title -->
        <div id="logohoder">
            <div id="logos">
                <img src="{{ asset('img/app_logo.png') }}" alt="logo">
                <h1>Adway</h1>
            </div>
        </div>
       

        <!-- Hamburger (Visible only on mobile) -->
      

        <!-- Middle: Nav Links -->
        <div class="nav-links" id="navLinks">
            @if(Auth::check() && Auth::user()->type == "Billboard Owner")
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('bookings') }}">
                    <i style="margin-right: 5px;" class="fas fa-clipboard-list"></i>Bookings
                </a>
                <a href="{{ route('owner.analytics') }}">Analytics</a>
            @else
                <a href="{{ route('home.user') }}">Home</a>
                <a href="{{route('billboards')}}">Billboards</a>
                <a href="{{ route('booked.user') }}">
                    <i style="margin-right: 5px;" class="fas fa-clipboard-list"></i>Booked
                </a>
            @endif

            <a href="{{route('aboutus')}}">About us</a>
            
            @if(Auth::check() && Auth::user()->is_admin == 'yes')
                <a href="{{ route('admin') }}">Admin</a>
            @endif
        </div>

        <!-- Right: User -->
        <div class="nav-user" id="navUser">
            @if (Auth::check())
                <a href="{{ route('profile') }}" class="nav-user-link">
                    <i class="fa-solid fa-circle-user"></i>
                    {{ Auth::user()->name }}
                </a>
            @else
                <a class="nav-user-link" href="{{ route('login') }}">Login</a>
            @endif
        </div>
    </nav>
    <div class="hamburger" id="hamburger" onclick="toggleNav()">
        <i class="fas fa-bars"></i>
    </div>
</header>
<script>
    function toggleNav() {
            const nav = document.getElementById("mainNav");
            const hamburger = document.getElementById("hamburger");
            const icon = hamburger.querySelector("i");

            nav.classList.toggle("open");
            hamburger.classList.toggle("active");

            // Switch between bars and times
            if (icon.classList.contains("fa-bars")) {
                icon.classList.remove("fa-bars");
                icon.classList.add("fa-times");
            } else {
                icon.classList.remove("fa-times");
                icon.classList.add("fa-bars");
            }
        }
</script>