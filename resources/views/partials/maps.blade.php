<!-- Include Leaflet CSS & JS in your head -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- GSAP already included above -->

<section id="map-section" style="padding: 50px 20px; background: white; text-align: center;">
    <h2 style="font-size: 2.8rem; margin-bottom: 10px; color: #223344;">Explore Available Billboards</h2>
    <p style="margin-bottom: 40px; color: #667788; font-size: 1.1rem;">Click on a pin to see billboard details</p>

    <div id="billboardMap"
        style="height: 450px; max-width: 1000px; margin: 0 auto; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    </div>
</section>

<script>
    // Sample billboard data — replace with dynamic data from your backend
    const billboards = [
        { id: 1, name: "Central Square Billboard", lat: 9.03, lng: 38.74, address: "Central Square, Addis Ababa", price: "$1200 / month" },
        { id: 2, name: "Main Street Billboard", lat: 9.04, lng: 38.75, address: "Main St, Addis Ababa", price: "$900 / month" },
        { id: 3, name: "Airport Road Billboard", lat: 9.02, lng: 38.70, address: "Airport Rd, Addis Ababa", price: "$1500 / month" },
        { id: 4, name: "City Center Billboard", lat: 9.05, lng: 38.73, address: "City Center, Addis Ababa", price: "$1300 / month" },
        { id: 5, name: "University Road Billboard", lat: 9.06, lng: 38.76, address: "University Rd, Addis Ababa", price: "$1100 / month" }
    ];

    // Initialize Leaflet map
    const map = L.map('billboardMap').setView([9.03, 38.74], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Custom icon
    const billboardIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/854/854878.png',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40],
    });

    // Add markers and popups
    billboards.forEach(billboard => {
        const marker = L.marker([billboard.lat, billboard.lng], { icon: billboardIcon }).addTo(map);
        marker.bindPopup(`
      <div style="font-weight: bold; font-size: 1.2rem; color: #2a90ff;">${billboard.name}</div>
      <div style="margin: 6px 0;">${billboard.address}</div>
      <div style="color: #444;">Price: <strong>${billboard.price}</strong></div>
      <button onclick="alert('You clicked on ${billboard.name}')" style="margin-top: 8px; padding: 6px 12px; background: #2a90ff; color: white; border: none; border-radius: 6px; cursor: pointer;">Book Now</button>
    `);
    });

    // Animate map container entrance with GSAP
    gsap.from("#billboardMap", {
        opacity: 0,
        y: 50,
        duration: 1.2,
        ease: "power3.out"
    });
</script>