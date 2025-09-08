<!-- Include GSAP CDN in your head -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<section id="pricing" style="padding: 50px 20px; background: #f9faff; text-align: center;">
    <h2 class="pricing-title" style="font-size: 2.8rem; margin-bottom: 10px; color: #223344;">Pricing & Packages</h2>
    <p class="pricing-subtitle" style="margin-bottom: 40px; color: #667788; font-size: 1.1rem;">Choose the perfect
        package for your advertising needs</p>

    <div class="pricing-cards"
        style="display: flex; justify-content: center; gap: 24px; flex-wrap: wrap; max-width: 1000px; margin: 0 auto;">
        <div class="card basic"
            style="flex: 1 1 280px; background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 30px; cursor: pointer; transition: transform 0.3s ease;">
            <h3 class="card-title" style="font-size: 1.6rem; margin-bottom: 10px; color: #333;">Basic</h3>
            <p class="card-price" style="font-size: 2rem; color: #2a90ff; margin-bottom: 20px;">$49 <small
                    style="font-size: 1rem; color: #666;">/ month</small></p>
            <ul class="card-features" style="text-align: left; margin-bottom: 30px; color: #555;">
                <li>Up to 5 Billboards</li>
                <li>Basic Analytics</li>
                <li>Email Support</li>
            </ul>
            <button class="card-button"
                style="background-color: #2a90ff; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold;">Choose
                Plan</button>
        </div>

        <div class="card recommended"
            style="flex: 1 1 320px; background: #2a90ff; border-radius: 12px; box-shadow: 0 8px 20px rgba(42, 144, 255, 0.4); padding: 35px; color: white; cursor: pointer; position: relative; transition: transform 0.3s ease;">
            <div
                style="position: absolute; top: -12px; right: -12px; background: #ffdd57; color: #223344; padding: 6px 14px; border-radius: 30px; font-weight: bold; font-size: 0.9rem; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                Recommended</div>
            <h3 class="card-title" style="font-size: 1.8rem; margin-bottom: 10px;">Pro</h3>
            <p class="card-price" style="font-size: 2.4rem; margin-bottom: 20px;">$99 <small
                    style="font-size: 1.1rem; color: #d3e3ff;">/ month</small></p>
            <ul class="card-features" style="text-align: left; margin-bottom: 30px;">
                <li>Up to 15 Billboards</li>
                <li>Advanced Analytics</li>
                <li>Priority Support</li>
                <li>Custom Branding</li>
            </ul>
            <button class="card-button"
                style="background-color: #ffdd57; color: #223344; border: none; padding: 14px 30px; border-radius: 8px; font-weight: bold;">Choose
                Plan</button>
        </div>

        <div class="card enterprise"
            style="flex: 1 1 280px; background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 30px; cursor: pointer; transition: transform 0.3s ease;">
            <h3 class="card-title" style="font-size: 1.6rem; margin-bottom: 10px; color: #333;">Enterprise</h3>
            <p class="card-price" style="font-size: 2rem; color: #2a90ff; margin-bottom: 20px;">Custom Pricing</p>
            <ul class="card-features" style="text-align: left; margin-bottom: 30px; color: #555;">
                <li>Unlimited Billboards</li>
                <li>Dedicated Account Manager</li>
                <li>Personalized Reports</li>
                <li>24/7 Support</li>
            </ul>
            <button class="card-button"
                style="background-color: #2a90ff; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold;">Contact
                Us</button>
        </div>
    </div>
</section>

<script>
    gsap.from(".pricing-title", { opacity: 0, y: -30, duration: 1, delay: 0.2, ease: "power4.out" });
    gsap.from(".pricing-subtitle", { opacity: 0, y: -20, duration: 1, delay: 0.4, ease: "power4.out" });

    gsap.from(".card", {
        opacity: 0,
        y: 40,
        duration: 1,
        stagger: 0.3,
        ease: "power3.out",
        delay: 0.6
    });

    // Add bounce on hover with JS (not only CSS)
    document.querySelectorAll(".card").forEach(card => {
        card.addEventListener("mouseenter", () => {
            gsap.to(card, { scale: 1.05, duration: 0.3, ease: "back.out(1.7)" });
        });
        card.addEventListener("mouseleave", () => {
            gsap.to(card, { scale: 1, duration: 0.3, ease: "power2.inOut" });
        });
    });
</script>