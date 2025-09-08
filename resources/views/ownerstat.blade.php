<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Billboard Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 32px;
            color: #222;
            margin-bottom: 20px;
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

        #home {
            color: #ffffff;
            background-color: dodgerblue;
            text-decoration: none;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        #home:hover,
        #home.active {
            background-color: rgb(9, 73, 137);
            color: white;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            flex: 1 1 220px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            font-size: 16px;
            color: #666;
            margin-bottom: 8px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }

        .charts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .chart-wrapper {
            height: 350px;
            position: relative;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
        }
        .nav-download-wrapper {
    display: flex;
    flex-direction: column; /* vertical stack */
    align-items: flex-end;  /* right align */
    gap: 12px;              /* space between link and button */
    margin-bottom: 20px;
}

#home, #downloadPdf {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    font-weight: 600;
    padding: 10px 16px;
    border-radius: 6px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s;
    border: none;
    }

    #home {
        color: #fff;
        background-color: dodgerblue;
    }

    #home:hover, #home.active {
        background-color: rgb(9, 73, 137);
        color: #fff;
    }

    #downloadPdf {
        background-color: #e53e3e; /* red */
        color: white;
        border: none;
    }

    #downloadPdf:hover {
        background-color: #9b2c2c;
    }


        @media (max-width: 768px) {
            .charts {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
<h1>📊 Billboard Analytics Dashboard</h1>
<div style="display: flex; justify-content: flex-end;">
    <div class="nav-download-wrapper">
        <a id="home" href="{{ route('home') }}">
            <i class="fa-solid fa-house"></i> Return to Home Page
        </a>
        <button id="downloadPdf">
            <i class="fa-solid fa-file-pdf"></i> Download as PDF
        </button>
    </div>

</div>
<div class="filter">
    <form method="GET" action="{{ route('owner.analytics') }}">
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

<div class="cards">
    <div class="card">
        <h3>Total Earnings</h3>
        <p><span class="count" data-target="{{ $totalEarnings }}">{{ $totalEarnings }}</span> ETB</p>
    </div>
    <div class="card">
        <h3>Total Bookings</h3>
        <p><span class="count" data-target="{{ $totalBookings }}">{{ $totalBookings }}</span></p>
    </div>
    <div class="card">
        <h3>Approved Bookings</h3>
        <p><span class="count" data-target="{{ $bookingStatus['approved'] ?? 0 }}">{{ $bookingStatus['approved'] ?? 0 }}</span></p>
    </div>
    <div class="card">
        <h3>Paid Bookings</h3>
        <p><span class="count" data-target="{{ $paymentStatus['paid'] ?? 0 }}">{{ $paymentStatus['paid'] ?? 0 }}</span></p>
    </div>
    <div class="card">
        <h3>Average Booking Value</h3>
        <p><span class="count" data-target="{{ number_format($averageBookingValue, 2, '.', '') }}">{{ number_format($averageBookingValue, 2, '.', '') }}</span> ETB</p>
    </div>
    <div class="card">
        <h3>Peak Earning Day</h3>
        <p>{{ $peakEarningDay ?? 'N/A' }}</p>
    </div>
    <div class="card">
        <h3>Peak Earning Amount</h3>
        <p><span class="count" data-target="{{ $peakEarningAmount ?? 0 }}">{{ $peakEarningAmount ?? 0 }}</span> ETB</p>
    </div>
    <div class="card">
        <h3>Most Common Booking Duration</h3>
        <p>{{ $mostCommonDuration ?? 'N/A' }} days</p>
    </div>
</div>

<div class="charts">
    <div class="card">
        <h3>Earnings Over Time</h3>
        <div class="chart-wrapper">
            <canvas id="earningsChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h3>Payment Status Distribution</h3>
        <div class="chart-wrapper">
            <canvas id="paymentStatusChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h3>Booking Approval Status</h3>
        <div class="chart-wrapper">
            <canvas id="approvalStatusChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h3>Top 5 Earning Billboards</h3>
        <div class="chart-wrapper">
            <canvas id="topBillboardsChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h3>Bookings by Weekday</h3>
        <div class="chart-wrapper">
            <canvas id="weekdayChart"></canvas>
        </div>
    </div>
</div>
<script>
    // ===== Counter Animation =====
    document.querySelectorAll('.count').forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const format = target.toString().includes(".");
        let count = 0;
        const speed = 40;
        const step = target / speed;

        function update() {
            if (count < target) {
                count += step;
                counter.innerText = format ? count.toFixed(2) : Math.floor(count);
                requestAnimationFrame(update);
            } else {
                counter.innerText = format ? target.toFixed(2) : target.toLocaleString();
            }
        }

        update();
    });

    // ===== Line Chart (Earnings Over Time) =====
    new Chart(document.getElementById('earningsChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($earningOverTime->toArray())) !!},
            datasets: [{
                label: 'ETB Earned',
                data: {!! json_encode(array_values($earningOverTime->toArray())) !!},
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => `ETB ${ctx.raw}`
                    }
                },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: val => `ETB ${val}`,
                    font: { weight: 'bold' },
                    color: '#2c3e50'
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            },
            scales: {
                y: { beginAtZero: true }
            }
        },
        plugins: [ChartDataLabels]
    });

    // ===== Pie Chart (Payment Status) =====
    new Chart(document.getElementById('paymentStatusChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($paymentStatus->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($paymentStatus->toArray())) !!},
                backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#6c757d']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                animateScale: true,
                easing: 'easeOutBounce',
                duration: 2000
            }
        }
    });

    // ===== Doughnut Chart (Approval Status) =====
    new Chart(document.getElementById('approvalStatusChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($bookingStatus->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($bookingStatus->toArray())) !!},
                backgroundColor: ['#007bff', '#ff5e5e', '#ffa726']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                animateRotate: true,
                easing: 'easeOutElastic',
                duration: 3000
            }
        }
    });

    // ===== Bar Chart (Top 5 Earning Billboards) =====
    new Chart(document.getElementById('topBillboardsChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($topBillboards->toArray())) !!},
            datasets: [{
                label: 'ETB Earned',
                data: {!! json_encode(array_values($topBillboards->toArray())) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => `ETB ${ctx.raw}`
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

    // ===== Bar Chart (Bookings by Weekday) =====
    new Chart(document.getElementById('weekdayChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($weekdayBookings->toArray())) !!},
            datasets: [{
                label: 'Number of Bookings',
                data: {!! json_encode(array_values($weekdayBookings->toArray())) !!},
                backgroundColor: 'rgba(255, 159, 64, 0.6)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    document.getElementById('downloadPdf').addEventListener('click', () => {
            const element = document.body; // or a specific div id

            html2canvas(element).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jspdf.jsPDF('p', 'pt', 'a4');
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('billboard_analytics.pdf');
            });
        });
</script>
</body>
</html>