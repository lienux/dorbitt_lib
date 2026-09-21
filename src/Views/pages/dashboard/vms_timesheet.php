
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Report Timesheet - Voyage Management System (Bootstrap 4)</title>
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light text-dark">

    <div class="min-vh-100 d-flex flex-column">
        
        <!-- Header -->
        <header class="bg-primary text-white shadow-sm py-3 mb-4">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-ship fa-2x text-info mr-3"></i>
                    <h1 class="h5 mb-0 font-weight-bold">VMS - Voyage Management System</h1>
                </div>
                <div class="text-sm bg-primary border border-light px-3 py-1 rounded">
                    <i class="fa-solid fa-user-circle mr-1"></i> M. Ali Imron
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container flex-grow-1 mb-5">
            
            <!-- Judul & Filter Voyage -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                <div>
                    <h2 class="h4 font-weight-bold text-dark">Dashboard & Report Voyage</h2>
                    <p class="text-muted small mb-0">Analisis performa pelayaran, konsumsi bahan bakar, dan statistik harian berdasarkan timesheet.</p>
                </div>
                <div class="d-flex align-items-center mt-3 mt-md-0">
                    <select class="form-control form-control-sm mr-2" style="width: 280px;">
                        <option>Voyage: VYG-2026-09A (MV Nusantara Indah)</option>
                        <option>Voyage: VYG-2026-08B (MV Nusantara Indah)</option>
                    </select>
                    <button class="btn btn-primary btn-sm text-nowrap shadow-sm">
                        <i class="fa-solid fa-download mr-1"></i> Export PDF
                    </button>
                </div>
            </div>

            <!-- SECTION: KPI Cards (Metrik Utama) -->
            <div class="row mb-4">
                <!-- Card 1: Total Jarak -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Total Jarak Tempuh</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark">1,450.2 <span class="small font-weight-normal text-muted">NM</span></div>
                                    <span class="text-success small mt-1 d-block"><i class="fa-solid fa-arrow-up"></i> 95% dari rencana</span>
                                </div>
                                <div class="col-auto">
                                    <div class="p-3 bg-light text-primary rounded-circle">
                                        <i class="fa-solid fa-route fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total Konsumsi FO -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Total Konsumsi FO</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark">42.5 <span class="small font-weight-normal text-muted">MT</span></div>
                                    <span class="text-warning small mt-1 d-block"><i class="fa-solid fa-triangle-exclamation"></i> Efisiensi normal</span>
                                </div>
                                <div class="col-auto">
                                    <div class="p-3 bg-light text-warning rounded-circle">
                                        <i class="fa-solid fa-gas-pump fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Rata-rata Kecepatan -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Kecepatan Rata-rata</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark">12.8 <span class="small font-weight-normal text-muted">Knots</span></div>
                                    <span class="text-primary small mt-1 d-block">Sesuai target service speed</span>
                                </div>
                                <div class="col-auto">
                                    <div class="p-3 bg-light text-success rounded-circle">
                                        <i class="fa-solid fa-gauge-high fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Sisa Fresh Water -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Sisa Air Bersih</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark">68.0 <span class="small font-weight-normal text-muted">MT</span></div>
                                    <span class="text-success small mt-1 d-block">Aman untuk 6 hari ke depan</span>
                                </div>
                                <div class="col-auto">
                                    <div class="p-3 bg-light text-info rounded-circle">
                                        <i class="fa-solid fa-droplet fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Grafik / Charts -->
            <div class="row mb-4">
                <!-- Grafik Konsumsi Bahan Bakar Harian -->
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-dark">
                                <i class="fa-solid fa-chart-line text-primary mr-2"></i> Tren Konsumsi Bahan Bakar Harian (MT)
                            </h6>
                        </div>
                        <div class="card-body">
                            <div style="height: 280px;">
                                <canvas id="fuelChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Distribusi Waktu Aktivitas Kapal -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-dark">
                                <i class="fa-solid fa-chart-pie text-primary mr-2"></i> Alokasi Status Aktivitas Kapal
                            </h6>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <div style="height: 260px; width: 100%;">
                                <canvas id="activityChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Ringkasan Laporan Perjalanan (Voyage Abstract Report) -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fa-solid fa-file-invoice text-primary mr-2"></i> Ringkasan Eksekutif Voyage (Abstract Log)
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row small">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="bg-light p-3 rounded border h-100">
                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">Informasi Rute</h6>
                                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Pelabuhan Asal:</span> <span class="font-weight-bold">Tanjung Priok, Jkt</span></div>
                                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Pelabuhan Tujuan:</span> <span class="font-weight-bold">Singapore Port</span></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">ETD / ETA:</span> <span class="font-weight-bold">20 Sep / 25 Sep</span></div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="bg-light p-3 rounded border h-100">
                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">Kalkulasi Bunker</h6>
                                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Bunker On Board (Rob):</span> <span class="font-weight-bold">120.0 MT</span></div>
                                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Total Konsumsi:</span> <span class="font-weight-bold">42.5 MT</span></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Sisa Estimasi FO:</span> <span class="font-weight-bold">77.5 MT</span></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light p-3 rounded border h-100">
                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">Kondisi Lingkungan</h6>
                                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Rata-rata Cuaca:</span> <span class="font-weight-bold">Moderate Sea</span></div>
                                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Arus Dominan:</span> <span class="font-weight-bold">Head Current (Light)</span></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Catatan Khusus:</span> <span class="text-primary font-weight-bold">Aman / Lancar</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <!-- Footer -->
        <footer class="bg-white border-top py-3 text-center text-muted small mt-auto">
            Voyage Management System &copy; 2026. All Rights Reserved.
        </footer>
    </div>

    <!-- Bootstrap 4 JavaScript dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Skrip Grafik Chart.js -->
    <script>
        // Grafik Konsumsi Bahan Bakar Harian
        const ctxFuel = document.getElementById('fuelChart').getContext('2d');
        new Chart(ctxFuel, {
            type: 'line',
            data: {
                labels: ['18 Sep', '19 Sep', '20 Sep (Load)', '21 Sep', '22 Sep'],
                datasets: [{
                    label: 'FO Consumed (MT)',
                    data: [0, 0, 1.2, 9.0, 8.5],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Grafik Distribusi Aktivitas Kapal
        const ctxActivity = document.getElementById('activityChart').getContext('2d');
        new Chart(ctxActivity, {
            type: 'doughnut',
            data: {
                labels: ['Steaming', 'Loading', 'Anchored / Waiting'],
                datasets: [{
                    data: [70, 20, 10],
                    backgroundColor: ['#28a745', '#007bff', '#ffc107'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
</body>
</html>