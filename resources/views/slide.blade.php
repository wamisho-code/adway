@include('partials.status')
<section id="contact-card-section" class="contact-card-section">
    <div class="contact-card">
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p>Have questions or want to work together? Send us a message!</p>
            <ul>
                <li><i class="fas fa-phone"></i> +1 123 456 7890</li>
                <li><i class="fas fa-envelope"></i> contact@yourdomain.com</li>
                <li><i class="fas fa-map-marker-alt"></i> 123 Main St, Your City</li>
            </ul>
            <form id="contactForm" method="POST" class="contact-form" action="{{route('contact-us-mail')}}">
                @csrf
                <input type="text" name="name" placeholder="Your Name" required autocomplete="name"  value="{{
                Auth::check() ? 
                    Auth::user()->name : " "
                }}"/>
                <input type="email" name="email" placeholder="Your Email" required autocomplete="email" value="{{
                Auth::check()? Auth::user()->email: " "
                }}" />
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message <i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
        <!-- Replace image with Lottie animation -->
        <div class="contact-animation">
            <lottie-player src="{{asset('./lotti/Contact us (21).json')}}" background="transparent"
                speed="1" style="width: 100%; height: 100%;" loop autoplay>
            </lottie-player>
        </div>
    </div>
</section>

<style>
    #contact-card-section {
        max-width: 900px;
        margin: 3rem auto;
        padding: 2rem;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .contact-card {
        display: flex;
        flex-wrap: nowrap;
        gap: 3rem;
        align-items: stretch;
        /* Make children same height */
    }

    /* Left side with info + form */
    #contact-card-section .contact-info {
        flex: 1 1 60%;
        color: #222;
    }

    #contact-card-section .contact-info h2 {
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        color: #3343df;
    }

    #contact-card-section .contact-info p {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        color: #555;
    }

    #contact-card-section .contact-info ul {
        list-style: none;
        padding: 0;
        margin: 0 0 2rem 0;
    }

    #contact-card-section .contact-info ul li {
        font-size: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        color: #444;
    }

    #contact-card-section .contact-info ul li i {
        color: #3343df;
        margin-right: 12px;
        font-size: 1.3rem;
    }

    /* Form styles */
    #contact-card-section .contact-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    #contact-card-section .contact-form input,
    #contact-card-section .contact-form textarea {
        padding: 0.8rem 1rem;
        border: 2px solid #ccc;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        resize: none;
    }

    #contact-card-section .contact-form input:focus,
    #contact-card-section .contact-form textarea:focus {
        outline: none;
        border-color: #3343df;
        box-shadow: 0 0 8px rgba(51, 67, 223, 0.4);
    }

    #contact-card-section .contact-form button {
        background-color: #3343df;
        border: none;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 0.9rem;
        border-radius: 10px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        transition: background-color 0.3s ease;
    }

    #contact-card-section .contact-form button:hover {
        background-color: #2a35b1;
    }

    #contact-card-section .contact-form button i {
        font-size: 1.1rem;
    }

    /* Right side Lottie animation */
    #contact-card-section .contact-animation {
        flex: 1 1 35%;
        border-radius: 12px;
        min-height: auto;
        max-height: 100%;
        display: flex;
        align-items: center;
    }

    #contact-card-section .contact-animation lottie-player {
        width: 100%;
        height: 100%;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .contact-card {
            flex-direction: column;
        }

        #contact-card-section .contact-animation {
            width: 100%;
            height: 250px;
            margin-top: 2rem;
        }
    }
</style>

<!-- FontAwesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<!-- Lottie Player CDN -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>