<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Why Choose Us</title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- GSAP CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f7fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .choose-us-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            padding: 60px 20px;
        }

        .person-image-container {
            position: relative;
            flex: 1 1 350px;
            max-width: 400px;
            min-height: 500px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .person-image {
            width: 100%;
            height: 100%;
            background-image: url({{ asset('img/thinker.png') }});
            background-size: contain;
            background-position: center bottom;
            background-repeat: no-repeat;
        }

        /* Create the curved ring shape at the bottom */
        .ring-overlay {
            position: absolute;
            bottom: 0;
            width: 120px;
            height: 60px;
            background: white;
            border: 6px solid #1e3a8a;
            border-radius: 100px 100px 0 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            z-index: 2;
            transform: translateY(50%);
        }


        .why-choose-us {
            flex: 1 1 500px;
            background: #f8faff;
            border-radius: 12px;
            padding: 40px 30px;
            box-shadow: 0 15px 40px rgba(0, 115, 230, 0.1);
        }

        .why-choose-us h2 {
            text-align: center;
            font-size: 2.6rem;
            margin-bottom: 50px;
            color: #1e3a8a;
            font-weight: 700;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 32px;
        }

        .feature-card {
            background: white;
            border-radius: 14px;
            padding: 30px 25px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
            text-align: center;
            transition: box-shadow 0.3s ease;
        }

        .feature-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .feature-card .icon {
            font-size: 3.6rem;
            color: #1e3a8a;
            margin-bottom: 18px;
        }

        .feature-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1e3a8a;
        }

        .feature-card p {
            font-size: 1rem;
            color: #555;
            line-height: 1.5;
        }

        .cta-container {
            margin-top: 50px;
            text-align: center;
        }

        .btn-primary {
            background: #1e3a8a;
            color: white;
            font-weight: 700;
            font-size: 1.3rem;
            padding: 15px 48px;
            border-radius: 40px;
            box-shadow: 0 8px 20px rgba(30, 58, 138, 0.4);
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #1451b8;
            box-shadow: 0 12px 28px rgba(20, 81, 184, 0.6);
        }

        @media (max-width: 768px) {
            .choose-us-wrapper {
                flex-direction: column;
            }

            .person-image {
                order: -1;
                min-height: 300px;
            }

            .why-choose-us {
                padding: 30px 20px;
            }

            .btn-primary {
                padding: 14px 36px;
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>

    <div class="choose-us-wrapper">
       


        <section class="why-choose-us">
            <h2>Why Choose Us?</h2>
            <div class="features">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-handshake"></i></div>
                    <h3>Trusted Connections</h3>
                    <p>We bring billboard owners and advertisers together with trust and transparency.</p>
                </div>
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-bullhorn"></i></div>
                    <h3>Effective Advertising</h3>
                    <p>Maximize your reach with prime billboard locations and targeted campaigns.</p>
                </div>
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-chart-line"></i></div>
                    <h3>Data-Driven Insights</h3>
                    <p>Track performance and optimize your advertising strategy with real-time analytics.</p>
                </div>
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                    <h3>Easy Management</h3>
                    <p>Manage your bookings and campaigns easily from any device, anytime.</p>
                </div>
            </div>
            <div class="cta-container">
                <a href="/signup" class="btn-primary" aria-label="Get Started Now">See How It Works</a>
            </div>
        </section>
    </div>

    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Animate the whole section in
        gsap.from(".why-choose-us", {
            duration: 1.6,
            opacity: 0,
            scale: 0.8,
            y: -60,
            ease: "power3.out"
        });

        // Animate heading
        gsap.from(".why-choose-us h2", {
            duration: 1.2,
            scale: 0,
            ease: "elastic.out(1, 0.5)",
            delay: 0.5
        });

        // Animate feature cards
        gsap.from(".feature-card", {
            scrollTrigger: {
                trigger: ".features",
                start: "top 80%",
            },
            duration: 1.4,
            opacity: 0,
            x: -100,
            rotation: -10,
            scale: 0.9,
            ease: "elastic.out(1, 0.4)",
            stagger: 0.25
        });

        // Pulse icons
        gsap.to(".feature-card .icon", {
            scale: 1.15,
            repeat: -1,
            yoyo: true,
            duration: 1.2,
            ease: "sine.inOut",
            delay: 2
        });

        // Button animation on hover
        const btn = document.querySelector(".btn-primary");
        btn.addEventListener("mouseenter", () => {
            gsap.to(btn, {
                scale: 1.1,
                boxShadow: "0 20px 40px rgba(20, 81, 184, 0.9)",
                duration: 0.4,
                ease: "power1.out"
            });
        });
        btn.addEventListener("mouseleave", () => {
            gsap.to(btn, {
                scale: 1,
                boxShadow: "0 12px 28px rgba(20, 81, 184, 0.6)",
                duration: 0.4,
                ease: "power1.out"
            });
        });

        // Animate the person image on scroll
        gsap.to("#personImage", {
            scrollTrigger: {
                trigger: "#personImage",
                start: "top 90%",
            },
            opacity: 1,
            x: 0,
            duration: 1.5,
            ease: "power3.out"
        });
    </script>

</body>

</html>