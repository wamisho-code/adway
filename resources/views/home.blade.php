<x-layouts.app>
    
        @if (!Auth::user() || Auth::user()->type == "Advertiser" )
            <section class="hero">
                <video autoplay muted loop class="hero-video">
                    <source src="{{ asset('videos/Times Square Video Billboard 3D Ads - October 20, 2024.mp4') }}"
                        type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="overlay"></div>
                <div class="hero-content">
                    <h1>Advertise your brand and event on Billboard now!</h1>
                    <p>Reach your audience with ease. Showcase your product, service, or event with our platform.</p>
                    <a href="#billboardlist" class="get-started-btn">Get Started</a>

                </div>
            </section>


   
        @else
            <a href="{{ route('addBillBoard') }}" class="add-billboard-link">Add New Billboard</a>
            @if($billboards->count() && !isset($showallbb))
                @includeWhen(isset($owner) && $owner, 'billboards.partials.billboardisplay', ['billboards' => $billboards])
            @endif
        @endif
        
    
</x-layouts.app>