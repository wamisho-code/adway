<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>About — LYUAD</title>
    <meta name="description" content="LYUAD — connecting billboard owners, advertisers and creators.">
    <style>
        :root {
            --bg: #0f1724;
            /* deep navy */
            --card: #0b1220;
            --muted: #9aa7bd;
            --accent: #6ee7b7;
            --accent-2: #60a5fa;
            --glass: rgba(255, 255, 255, 0.04);
            --radius: 14px;
            --fw-strong: 700;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            height: 100%
        }

        body {
            margin: 0;
            background: linear-gradient(180deg, var(--bg) 0%, #061022 100%);
            color: #e6eef8;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.45;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto
        }

        .card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: 0 6px 30px rgba(2, 6, 23, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.03);
        }

        header.top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px
        }

        .brand {
            display: flex;
            gap: 14px;
            align-items: center
        }

        .logo-mark {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            font-weight: 800;
            color: #05242b;
            font-size: 18px;
            letter-spacing: 1px
        }

        .brand h1 {
            font-size: 20px;
            margin: 0
        }

        .brand p {
            margin: 0;
            color: var(--muted);
            font-size: 13px
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px
        }

        @media (max-width:880px) {
            .grid {
                grid-template-columns: 1fr
            }
        }

        /* left column */
        .hero {
            margin-bottom: 18px
        }

        .eyebrow {
            display: inline-block;
            padding: 6px 10px;
            background: var(--glass);
            border-radius: 999px;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 12px
        }

        h2 {
            margin: 6px 0 10px;
            font-size: 28px
        }

        p.lead {
            color: var(--muted);
            font-size: 15px;
            margin: 0 0 18px
        }

        .features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-top: 14px
        }

        @media (max-width:640px) {
            .features {
                grid-template-columns: 1fr
            }
            .home-btn {
                
                margin-left: 20px;
                font-size: 12px;
                padding: 0px;
                text-align: center;
            }
        }

        .feature {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.012), rgba(255, 255, 255, 0.01));
            padding: 12px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.02)
        }

        .feature h4 {
            margin: 0 0 6px;
            font-size: 15px
        }

        .feature p {
            margin: 0;
            color: var(--muted);
            font-size: 13px
        }

        /* stats strip */
        .stats {
            display: flex;
            gap: 12px;
            margin-top: 18px
        }

        .stat {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.01), rgba(255, 255, 255, 0.008));
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.02)
        }

        .stat strong {
            display: block;
            font-size: 20px;
            color: var(--accent);
            font-weight: 800
        }

        .stat span {
            display: block;
            color: var(--muted);
            font-size: 12px
        }

        /* right column */
        aside.info {
            position: relative
        }

        .meta {
            display: flex;
            flex-direction: column;
            gap: 12px
        }

        .meta .small {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
            padding: 14px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.02)
        }

        .meta h3 {
            margin: 0 0 6px
        }

        .meta p {
            margin: 0;
            color: var(--muted);
            font-size: 13px
        }

        /* CTA */
        .cta {
            margin-top: 14px;
            padding: 14px;
            border-radius: 12px;
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.08), rgba(111, 233, 182, 0.04));
            border: 1px solid rgba(255, 255, 255, 0.02)
        }

        .cta a {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            color: #021018;
            font-weight: 700;
            text-decoration: none
        }

        footer.small {
            margin-top: 18px;
            color: var(--muted);
            font-size: 13px;
            text-align: center
        }

        /* little decorative floating shapes (pure CSS) */
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(30px);
            opacity: 0.12
        }

        .shape.s1 {
            width: 220px;
            height: 220px;
            right: -60px;
            top: -40px;
            background: linear-gradient(135deg, var(--accent), transparent)
        }

        .shape.s2 {
            width: 120px;
            height: 120px;
            left: -40px;
            bottom: -40px;
            background: linear-gradient(135deg, var(--accent-2), transparent)
        }

        /* subtle animations */
        @keyframes floaty {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-6px)
            }

            100% {
                transform: translateY(0)
            }
        }

        .logo-mark {
            animation: floaty 4s ease-in-out infinite
        }

        /* FAQ-like list */
        dl {
            margin: 14px 0 0
        }

        dt {
            font-weight: 700;
            margin-top: 12px
        }

        dd {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 14px
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="top card">
            <div class="brand">
                <div class="logo-mark">LY</div>
                <div>
                    <h1>LYUAD</h1>
                    <p>Digital marketplace for billboards — owners, advertisers & creators united.</p>
                </div>
            </div>
            
            <div style="text-align:right">
                <div style="color:var(--muted);font-size:13px">Trusted • Local-first • Easy</div>
            </div>
            <div>
                <a class="home-btn" style="display: inline-block;
                        padding: 6px 10px;
                        border-radius: 6px;
                        background: linear-gradient(90deg, var(--accent), var(--accent-2));
                        color: #021018;
                        font-weight: 500;
                        text-decoration: none" href="{{route('home.user')}}" role="button">Home Page</a>
            </div>
        </header>

        <main class="grid">
            <section>
                <article class="card hero">
                    <span class="eyebrow">About Us</span>
                    <h2>We make billboards work for everyone</h2>
                    <p class="lead">LYUAD connects billboard owners with advertisers and creators who want to publish
                        photos and videos on outdoor screens. We make discovery, booking and creative delivery simple —
                        whether you're an owner monetizing space or an advertiser looking for real-world reach.</p>

                    <div class="features">
                        <div class="feature">
                            <h4>For Owners</h4>
                            <p>List your locations, set availability and pricing, and get bookings from verified
                                advertisers — all from one dashboard.</p>
                        </div>
                        <div class="feature">
                            <h4>For Advertisers</h4>
                            <p>Search by city, audience and price; schedule campaigns; and receive delivery reports with
                                impressions and play counts.</p>
                        </div>
                        <div class="feature">
                            <h4>For Creators</h4>
                            <p>Upload images or short videos, choose formats, and publish to multiple billboards without
                                fiddly exports.</p>
                        </div>
                        <div class="feature">
                            <h4>Secure Payments</h4>
                            <p>Integrated payments and escrow protect both owners and advertisers until campaigns run as
                                promised.</p>
                        </div>
                    </div>

                    <div class="stats" aria-hidden>
                        <div class="stat"><strong>+1,200</strong><span>Billboard listings</span></div>
                        <div class="stat"><strong>+3,500</strong><span>Campaigns delivered</span></div>
                        <div class="stat"><strong>99%</strong><span>On-time publishing</span></div>
                    </div>

                    <dl>
                        <dt>Our mission</dt>
                        <dd>To make outdoor advertising accessible, transparent and efficient for local businesses and
                            creators.</dd>

                        <dt>How we work</dt>
                        <dd>We verify owners, provide an easy booking flow for advertisers, and offer built-in creative
                            tools so uploading photos and short videos is fast and compliant.</dd>
                    </dl>
                </article>

                <div class="card" style="margin-top:14px">
                    <h3 style="margin-top:0">Values that guide us</h3>
                    <ul style="margin:12px 0 0 18px;color:var(--muted)">
                        <li>Local empowerment — help owners earn consistently.</li>
                        <li>Fair pricing — transparent fees and clear receipts.</li>
                        <li>Reliability — timely play and helpful reports.</li>
                        <li>Simplicity — powerful tools, simple interface.</li>
                    </ul>
                </div>
            </section>

            <aside class="info">
                <div class="shape s1"></div>
                <div class="shape s2"></div>

                <div class="meta card">
                    <div class="small">
                        <h3>Who we serve</h3>
                        <p>Local advertisers, national brands, freelance creators and billboard owners who want a modern
                            way to monetize outdoor media.</p>
                    </div>

                    <div class="small">
                        <h3>Why choose LYUAD</h3>
                        <p>Clear pricing, verified partners, playback guarantees, and creative validation before
                            publishing.</p>
                    </div>

                    <div class="cta">
                        <div style="display:flex;gap:10px;align-items:center;justify-content:space-between">
                            <div>
                                <strong>Ready to publish?</strong>
                                <div style="color:var(--muted);font-size:13px">Get your first campaign on the road in
                                    under 10 minutes.</div>
                            </div>
                            <div>
                                <a href="{{route('billboards')}}" role="button">Get started</a>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="small">
                    <div style="color:var(--muted)">© {{ date('Y') }} LYUAD — Built for owners, advertisers & creators.
                    </div>
                </footer>
            </aside>
        </main>
    </div>
</body>

</html>