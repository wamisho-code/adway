<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <style>
        #report {
            page-break-inside: avoid;
        }
        .filter {
            margin-bottom: 30px;
        }

        .filter select {
            padding: 8px 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        #report * {
            break-inside: avoid;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        #report {
            page-break-inside: avoid;
        }

        #report > * {
            page-break-inside: avoid;
            break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
        }
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .chart-box {
            flex: 1;
            min-width: 300px;
            max-width: 48%;
            background: white;
            padding: 20px;
            border-radius: 15px;
        }

        canvas {
            width: 100% !important;
            height: auto !important;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin: 5px 0;
        }

        h3 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div id="report"  style="width: 100%; overflow: hidden;">
    <h1>Admin Statistics</h1>
    <div style="margin-bottom: 20px;">
        <button id="downloadPdf" style="cursor:pointer;border:none;padding: 10px 20px; background-color: #e06f13; color: white; border-radius: 5px; text-decoration: none;">
            <i class="fa-solid fa-file-pdf"></i> Download as PDF
        </button>
    </div>
    <div class="filter">
        <form method="GET" action="{{ route('admin-stat') }}">
            <label for="range">Filter by: </label>
            <select name="range" id="range" onchange="this.form.submit()">
                <option value="lifetime" {{ $range === 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                <option value="year" {{ $range === 'year' ? 'selected' : '' }}>This Year</option>
                <option value="month" {{ $range === 'month' ? 'selected' : '' }}>This Month</option>
                <option value="week" {{ $range === 'week' ? 'selected' : '' }}>This Week</option>
                <option value="day" {{ $range === 'day' ? 'selected' : '' }}>Today</option>
            </select>
        </form>
    </div>

    <div class="stat-grid">
        <div class="card">
            <h3>Total Earnings</h3><span id="earnings">{{ number_format($totalEarnings, 2) }}</span>
        </div>
        <div class="card">
            <h3>Total Bookings</h3><span id="bookings">{{ $totalBookings }}</span>
        </div>
        <div class="card">
            <h3>Average Booking Value</h3><span>{{ number_format($averageBookingValue, 2) }}</span>
        </div>
        <div class="card">
            <h3>Peak Earning Day</h3><span>{{ $peakEarningDay }} ({{ number_format($peakEarningAmount, 2) }})</span>
        </div>
        <div class="card">
            <h3>Most Common Duration</h3><span>{{ $mostCommonDuration }} Days</span>
        </div>
        <div class="card">
            <h3>Total Billboards</h3><span>{{ $totalBillboards }}</span>
        </div>
        <div class="card">
            <h3>Total Users</h3><span>{{ $totalUsers }}</span>
        </div>
        <div class="card">
            <h3>Total Advertisers</h3><span>{{ $totalAdvertisers }}</span>
        </div>
        <div class="card">
            <h3>Total Owners</h3><span>{{ $totalOwners }}</span>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-box">
            <h3>Booking Status</h3>
            <canvas id="bookingStatusChart"></canvas>
        </div>
        <div class="chart-box">
            <h3>Payment Status</h3>
            <canvas id="paymentStatusChart"></canvas>
        </div>
    </div>

    <div class="chart-box" style="margin-top: 30px;">
        <h3>Earning Over Time</h3>
        <canvas id="earningOverTimeChart"></canvas>
    </div>

    <div class="stat-grid" style="margin-top: 40px;">
        <div class="card">
            <h3>Top Billboards</h3>
            <ul>
                @foreach($topBillboards as $title => $earning)
                    <li>{{ $title }} - {{ number_format($earning, 2) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="card">
            <h3>Top Owners</h3>
            <ul>
                @foreach($topOwners as $owner => $earning)
                    <li>{{ $owner }} - {{ number_format($earning, 2) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="card">
            <h3>Top Advertisers</h3>
            <ul>
                @foreach($topAdvertisers as $adv => $earning)
                    <li>{{ $adv }} - {{ number_format($earning, 2) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="card">
            <h3>Bookings by Weekday</h3>
            <ul>
                @foreach($weekdayBookings as $day => $count)
                    <li>{{ $day }} - {{ $count }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

    <script>
        const bookingStatusChart = new Chart(document.getElementById('bookingStatusChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($bookingStatus->keys()) !!},
                datasets: [{
                    data: {!! json_encode($bookingStatus->values()) !!},
                    backgroundColor: ['#4CAF50', '#FFC107', '#F44336', '#2196F3']
                }]
            }
        });

        const paymentStatusChart = new Chart(document.getElementById('paymentStatusChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($paymentStatus->keys()) !!},
                datasets: [{
                    data: {!! json_encode($paymentStatus->values()) !!},
                    backgroundColor: ['#009688', '#E91E63', '#3F51B5', '#FF5722']
                }]
            }
        });

        const earningOverTimeChart = new Chart(document.getElementById('earningOverTimeChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($earningOverTime->keys()) !!},
                datasets: [{
                    label: 'Earnings',
                    data: {!! json_encode($earningOverTime->values()) !!},
                    borderColor: '#673AB7',
                    fill: false,
                    tension: 0.3,
                    pointRadius: 5,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `ETB ${context.raw.toFixed(2)}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Animated Counters
        function animateValue(id, start, end, duration) {
            const obj = document.getElementById(id);
            const frameRate = 60;
            const totalFrames = Math.round(duration / (1000 / frameRate));
            const increment = (end - start) / totalFrames;
            let current = start;
            let frame = 0;

            const timer = setInterval(() => {
                frame++;
                current += increment;
                if (frame >= totalFrames) {
                    clearInterval(timer);
                    current = end;
                }
                obj.innerText = Math.floor(current).toLocaleString();
            }, 1000 / frameRate);
        }


        animateValue("earnings", 0, {{ intval($totalEarnings) }}, 1500);
        animateValue("bookings", 0, {{ $totalBookings }}, 1000);
    document.getElementById('downloadPdf').addEventListener('click', () => {
            const element = document.getElementById('report'); // ✅ Only this div will be captured

            if (!element) {
                alert("Report section not found!");
                return;
            }

            html2canvas(element, {
                scale: 2, // Higher resolution for clarity
                useCORS: true
            }).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jspdf.jsPDF('p', 'pt', 'a4');

                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('admin_stat.pdf');
            });
        });



    </script>
</body>

</html>