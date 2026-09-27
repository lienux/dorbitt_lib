<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css"> -->
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<!-- jsPDF + AutoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

<style>
  :root {
    --bg-body: #f4f6f9;
    --bg-card: #ffffff;
    --text-main: #212529;
    --text-muted: #6c757d;
    --border-color: #e9ecef;
    --shadow: 0 2px 8px rgba(0,0,0,.05);
  }
  body.dark-mode {
    --bg-body: #14171c;
    --bg-card: #1e2229;
    --text-main: #e9ecef;
    --text-muted: #a0a7b3;
    --border-color: #2c313a;
    --shadow: 0 2px 8px rgba(0,0,0,.4);
  }
  body {
    background: var(--bg-body);
    color: var(--text-main);
    font-family: 'Segoe UI', Tahoma, sans-serif;
    transition: background .3s, color .3s;
  }
  .navbar-brand { font-weight: 700; letter-spacing: 1px; }
  .navbar-maritime { background: linear-gradient(90deg, #0b3d91 0%, #1e5fbf 100%); }
  body.dark-mode .navbar-maritime { background: linear-gradient(90deg, #061a3d 0%, #0b3d91 100%); }

  /* KPI CARDS */
  .kpi-card {
    border: none; border-radius: 12px; color: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform .2s;
  }
  .kpi-card:hover { transform: translateY(-4px); }
  .kpi-card .kpi-icon { font-size: 2.4rem; opacity: .35; }
  .kpi-card .kpi-value { font-size: 1.6rem; font-weight: 700; }
  .kpi-card .kpi-label { font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; opacity: .9; }
  .kpi-card .kpi-trend { font-size: .78rem; }
  .bg-tce-1 { background: linear-gradient(135deg,#1e5fbf,#0b3d91); }
  .bg-tce-2 { background: linear-gradient(135deg,#28a745,#1c7430); }
  .bg-tce-3 { background: linear-gradient(135deg,#ff8c00,#cc6a00); }
  .bg-tce-4 { background: linear-gradient(135deg,#6f42c1,#4a2a8a); }

  /* CARDS */
  .card {
    background: var(--bg-card); color: var(--text-main);
    border: none; border-radius: 10px;
    transition: background .3s, color .3s;
  }
  .card-header-custom {
    background: var(--bg-card); color: var(--text-main);
    border-bottom: 2px solid var(--border-color);
    font-weight: 600;
    border-radius: 10px 10px 0 0 !important;
  }
  .card-footer { background: var(--bg-card) !important; color: var(--text-muted); }

  /* TABLE */
  .table { color: var(--text-main); }
  .table thead th {
    background: #0b3d91; color: #fff;
    border-color: #0b3d91;
    font-size: .82rem; text-transform: uppercase; letter-spacing: .3px;
  }
  body.dark-mode .table thead th { background: #061a3d; border-color: #061a3d; }
  .table td { font-size: .88rem; vertical-align: middle; }
  .table-striped tbody tr:nth-of-type(odd) { background-color: rgba(0,0,0,.02); }
  body.dark-mode .table-striped tbody tr:nth-of-type(odd) { background-color: rgba(255,255,255,.03); }
  body.dark-mode .table-hover tbody tr:hover { background-color: rgba(255,255,255,.06); color: var(--text-main); }
  body.dark-mode .bg-light { background: #2c313a !important; }
  body.dark-mode .page-item.disabled .page-link,
  body.dark-mode .page-link { background: #2c313a; border-color: #3a4049; color: #e9ecef; }
  body.dark-mode .page-item.active .page-link { background: #1e5fbf; border-color: #1e5fbf; }
  body.dark-mode .dataTables_info,
  body.dark-mode .dataTables_length label,
  body.dark-mode .dataTables_filter label { color: var(--text-main); }

  .badge-profit { background: #d4edda; color: #155724; }
  .badge-loss   { background: #f8d7da; color: #721c24; }
  body.dark-mode .badge-profit { background: #1c7430; color: #d4edda; }
  body.dark-mode .badge-loss   { background: #721c24; color: #f8d7da; }

  /* FILTER BOX */
  .filter-box {
    background: var(--bg-card); border-radius: 10px;
    padding: 15px 20px; box-shadow: var(--shadow);
  }
  body.dark-mode .form-control {
    background: #2c313a; border-color: #3a4049; color: var(--text-main);
  }
  body.dark-mode .form-control:focus {
    background: #2c313a; color: var(--text-main); border-color: #1e5fbf;
  }
  body.dark-mode .input-group-text { background: #2c313a; border-color: #3a4049; color: var(--text-main); }

  /* CHARTS */
  .chart-container { position: relative; height: 280px; }
  .chart-container-sm { position: relative; height: 240px; }

  /* CHARTERER LIST */
  .charterer-row { padding: 8px 0; border-bottom: 1px dashed var(--border-color); }
  .charterer-row:last-child { border-bottom: none; }
  .charterer-name { font-weight: 600; font-size: .85rem; }
  .charterer-value { font-size: .8rem; color: var(--text-muted); }
  .progress { height: 8px; background: var(--border-color); }

  /* MAP */
  #map { height: 380px; border-radius: 8px; z-index: 1; }
  body.dark-mode .leaflet-tile { filter: brightness(0.6) invert(1) contrast(3) hue-rotate(200deg) saturate(0.3) brightness(0.7); }
  body.dark-mode .leaflet-container { background: #14171c; }

  /* YOY COMPARE CARDS */
  .yoy-card {
    padding: 12px 15px;
    border-radius: 8px;
    background: var(--bg-card);
    border-left: 4px solid #1e5fbf;
    margin-bottom: 10px;
  }
  .yoy-card.positive { border-left-color: #28a745; }
  .yoy-card.negative { border-left-color: #dc3545; }
  .yoy-label { font-size: .75rem; color: var(--text-muted); text-transform: uppercase; }
  .yoy-value { font-size: 1.1rem; font-weight: 700; }
  .yoy-delta { font-size: .85rem; font-weight: 600; }
  .yoy-delta.up { color: #28a745; }
  .yoy-delta.down { color: #dc3545; }

  /* MODAL EMAIL */
  body.dark-mode .modal-content { background: #1e2229; color: var(--text-main); }
  body.dark-mode .modal-header, body.dark-mode .modal-footer { border-color: var(--border-color); }
  body.dark-mode .close { color: #fff; text-shadow: none; }

  /* FOOTER */
  .footer { font-size: .8rem; color: var(--text-muted); padding: 20px 0; }

  /* LOADING */
  .loading-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,.5);
    display: none; align-items: center; justify-content: center;
    z-index: 9999; color: #fff;
  }
  .loading-overlay.active { display: flex; }

  /* TOAST */
  .toast-custom {
    position: fixed; top: 80px; right: 20px;
    z-index: 10000; min-width: 280px;
    background: #28a745; color: #fff;
    padding: 12px 18px; border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,.2);
    opacity: 0; transform: translateX(120%);
    transition: all .3s;
  }
  .toast-custom.show { opacity: 1; transform: translateX(0); }
  .toast-custom.error { background: #dc3545; }
  .toast-custom.info { background: #1e5fbf; }
</style>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-maritime shadow-sm my-4">
    <a class="navbar-brand" href="#"><i class="fas fa-ship mr-2"></i>TCE REPORT DASHBOARD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="#"><i class="fas fa-tachometer-alt mr-1"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#sectionVoyage"><i class="fas fa-file-invoice-dollar mr-1"></i>Voyage</a></li>
            <li class="nav-item"><a class="nav-link" href="#sectionAnalytics"><i class="fas fa-chart-line mr-1"></i>Analytics</a></li>
            <li class="nav-item"><a class="nav-link" href="#sectionMap"><i class="fas fa-map-marked-alt mr-1"></i>Map</a></li>
        </ul>
        <div class="d-flex align-items-center">
            <button class="btn btn-sm btn-outline-light btn-toggle-dark mr-2" id="btnDarkMode">
                <i class="fas fa-moon mr-1"></i>Dark Mode
            </button>
            <button class="btn btn-sm btn-outline-light" id="btnEmail" data-toggle="modal" data-target="#emailModal">
                <i class="fas fa-envelope mr-1"></i>Email
            </button>
        </div>
    </div>
</nav>

<!-- ================= FILTER ================= -->
<div class="filter-box mb-4">
<form class="form-row align-items-end" id="filterForm">
  <div class="col-md-2 mb-2">
    <label class="small font-weight-bold text-muted">VESSEL</label>
    <select class="form-control form-control-sm" id="filterVessel">
      <option value="">All Vessels</option>
      <option>MV Ocean Star</option>
      <option>MV Pacific Dawn</option>
      <option>MV Atlantic Breeze</option>
      <option>MV Indian Horizon</option>
    </select>
  </div>
  <div class="col-md-2 mb-2">
    <label class="small font-weight-bold text-muted">CHARTERER</label>
    <select class="form-control form-control-sm" id="filterCharterer">
      <option value="">All Charterers</option>
    </select>
  </div>
  <div class="col-md-2 mb-2">
    <label class="small font-weight-bold text-muted">STATUS</label>
    <select class="form-control form-control-sm" id="filterStatus">
      <option value="">All Status</option>
      <option>Completed</option>
      <option>Ongoing</option>
    </select>
  </div>
  <div class="col-md-2 mb-2">
    <label class="small font-weight-bold text-muted">DARI</label>
    <input type="date" class="form-control form-control-sm" id="filterDateFrom" value="2024-01-01">
  </div>
  <div class="col-md-2 mb-2">
    <label class="small font-weight-bold text-muted">SAMPAI</label>
    <input type="date" class="form-control form-control-sm" id="filterDateTo" value="2024-12-31">
  </div>
  <div class="col-md-2 mb-2 text-right">
    <button type="button" class="btn btn-primary btn-sm" id="btnApply"><i class="fas fa-filter mr-1"></i>Apply</button>
    <button type="button" class="btn btn-outline-secondary btn-sm" id="btnReset"><i class="fas fa-sync-alt"></i></button>
  </div>
  <div class="col-12 mt-2">
    <button type="button" class="btn btn-danger btn-sm" id="btnExportPdf"><i class="fas fa-file-pdf mr-1"></i>Export PDF</button>
    <button type="button" class="btn btn-success btn-sm" id="btnExportCsv"><i class="fas fa-file-csv mr-1"></i>Export CSV</button>
    <button type="button" class="btn btn-info btn-sm" id="btnEmailQuick"><i class="fas fa-paper-plane mr-1"></i>Send Report</button>
  </div>
</form>
</div>

<!-- ================= KPI CARDS ================= -->
<div class="row">
<div class="col-lg-3 col-md-6 mb-3">
  <div class="card kpi-card bg-tce-1">
    <div class="card-body d-flex justify-content-between align-items-center">
      <div>
        <div class="kpi-label">Avg TCE / Day</div>
        <div class="kpi-value" id="kpiAvgTce">$0</div>
        <small class="kpi-trend" id="kpiAvgTceTrend"><i class="fas fa-minus"></i> --</small>
      </div>
      <i class="fas fa-dollar-sign kpi-icon"></i>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 mb-3">
  <div class="card kpi-card bg-tce-2">
    <div class="card-body d-flex justify-content-between align-items-center">
      <div>
        <div class="kpi-label">Total Gross Revenue</div>
        <div class="kpi-value" id="kpiRevenue">$0</div>
        <small class="kpi-trend" id="kpiRevenueTrend"><i class="fas fa-minus"></i> --</small>
      </div>
      <i class="fas fa-chart-line kpi-icon"></i>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 mb-3">
  <div class="card kpi-card bg-tce-3">
    <div class="card-body d-flex justify-content-between align-items-center">
      <div>
        <div class="kpi-label">Total Voyage Cost</div>
        <div class="kpi-value" id="kpiCost">$0</div>
        <small class="kpi-trend" id="kpiCostTrend"><i class="fas fa-minus"></i> --</small>
      </div>
      <i class="fas fa-gas-pump kpi-icon"></i>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 mb-3">
  <div class="card kpi-card bg-tce-4">
    <div class="card-body d-flex justify-content-between align-items-center">
      <div>
        <div class="kpi-label">Total Voyages</div>
        <div class="kpi-value" id="kpiVoyages">0</div>
        <small class="kpi-trend" id="kpiVoyagesTrend"><i class="fas fa-minus"></i> --</small>
      </div>
      <i class="fas fa-route kpi-icon"></i>
    </div>
  </div>
</div>
</div>

<!-- ================= CHARTS ================= -->
<div class="row" id="sectionAnalytics">
<div class="col-lg-8 mb-3">
  <div class="card shadow-sm">
    <div class="card-header card-header-custom">
      <i class="fas fa-chart-area text-primary mr-1"></i> TCE Trend per Vessel (USD/Day)
    </div>
    <div class="card-body">
      <div class="chart-container"><canvas id="tceTrendChart"></canvas></div>
    </div>
  </div>
</div>
<div class="col-lg-4 mb-3">
  <div class="card shadow-sm">
    <div class="card-header card-header-custom">
      <i class="fas fa-chart-pie text-primary mr-1"></i> Komposisi Biaya Voyage
    </div>
    <div class="card-body">
      <div class="chart-container"><canvas id="costChart"></canvas></div>
    </div>
  </div>
</div>
</div>

<!-- ================= YoY COMPARISON + CHARTERER ================= -->
<div class="row">
<div class="col-lg-4 mb-3">
  <div class="card shadow-sm h-100">
    <div class="card-header card-header-custom">
      <i class="fas fa-calendar-alt text-primary mr-1"></i> Year over Year (YoY)
    </div>
    <div class="card-body" id="yoyContainer">
      <!-- Diisi JS -->
    </div>
  </div>
</div>
<div class="col-lg-4 mb-3">
  <div class="card shadow-sm h-100">
    <div class="card-header card-header-custom">
      <i class="fas fa-users text-primary mr-1"></i> TCE Breakdown per Charterer
    </div>
    <div class="card-body" id="chartererList" style="max-height: 340px; overflow-y: auto;">
      <!-- Diisi JS -->
    </div>
  </div>
</div>
<div class="col-lg-4 mb-3">
  <div class="card shadow-sm h-100">
    <div class="card-header card-header-custom">
      <i class="fas fa-chart-bar text-primary mr-1"></i> Kontribusi TCE Charterer
    </div>
    <div class="card-body">
      <div class="chart-container-sm"><canvas id="chartererChart"></canvas></div>
    </div>
  </div>
</div>
</div>

<!-- ================= PETA ROUTE ================= -->
<div class="row" id="sectionMap">
    <div class="col-12 mb-3">
        <div class="card shadow-sm">
            <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="fas fa-map-marked-alt text-primary mr-1"></i> Peta Route Voyage</span>
                <small class="text-muted" id="mapInfo">Memuat peta...</small>
            </div>
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>

<!-- ================= TABLE ================= -->
<div class="card shadow-sm mb-4" id="sectionVoyage">
    <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
        <span><i class="fas fa-table text-primary mr-1"></i> Detail Perhitungan TCE per Voyage</span>
        <span class="badge badge-primary" id="voyageCount">0 Voyages</span>
    </div>
    <div class="card-body p-3">
        <table class="table table-hover table-striped" id="tceTable" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vessel</th>
                    <th>Voyage</th>
                    <th>Route</th>
                    <th>Charterer</th>
                    <th class="text-right">Gross Freight ($)</th>
                    <th class="text-right">Voyage Cost ($)</th>
                    <th class="text-right">Hire Days</th>
                    <th class="text-right">TCE / Day ($)</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody id="tceTableBody"></tbody>
            <tfoot>
                <tr class="bg-light font-weight-bold">
                    <td colspan="5" class="text-right">TOTAL / AVERAGE</td>
                    <td class="text-right" id="totalRevenue">-</td>
                    <td class="text-right" id="totalCost">-</td>
                    <td class="text-right" id="totalDays">-</td>
                    <td class="text-right text-primary" id="avgTce">-</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="card-footer small">
        <i class="fas fa-info-circle mr-1"></i>
        <strong>Rumus TCE:</strong> (Gross Freight − Voyage Cost) ÷ Total Hire Days
    </div>
</div>

<!-- ================= MODAL EMAIL ================= -->
<div class="modal fade" id="emailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-envelope text-primary mr-2"></i>Kirim Report via Email</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="small font-weight-bold">Penerima</label>
                    <input type="email" class="form-control" id="emailTo" placeholder="manager@company.com" required>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold">CC (opsional)</label>
                    <input type="email" class="form-control" id="emailCc" placeholder="cc@company.com">
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold">Subject</label>
                    <input type="text" class="form-control" id="emailSubject" value="TCE Report — Maritime Chartering Division">
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold">Pesan</label>
                    <textarea class="form-control" id="emailBody" rows="4">Dear Team,
                    Berikut kami lampirkan laporan TCE (Time Charter Equivalent) untuk periode terkini. Mohon ditinjau.
                    Terima kasih.</textarea>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="emailAttachPdf" checked>
                  <label class="custom-control-label small" for="emailAttachPdf">
                    Sertakan ringkasan data di body email (PDF perlu attach manual)
                  </label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="btnSendEmail">
                  <i class="fas fa-paper-plane mr-1"></i>Kirim Email
                </button>
              </div>
            </div>
          </div>
                </div>

                <!-- ================= LOADING OVERLAY ================= -->
                <div class="loading-overlay" id="loadingOverlay">
                    <div class="text-center">
                        <i class="fas fa-spinner fa-spin fa-3x mb-3"></i>
                        <h5 id="loadingText">Memproses...</h5>
                    </div>
                </div>

                <!-- ================= TOAST ================= -->
                <div class="toast-custom" id="toast"><i class="fas fa-check-circle mr-2"></i><span id="toastMsg">Berhasil!</span></div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
/* =========================================================
   MASTER DATA — dengan koordinat route & tanggal
   ========================================================= */
const voyages = [
  { id:1,  vessel:"MV Ocean Star",     voyage:"VO-2401", route:"Singapore → Rotterdam",   charterer:"Maersk Line",   freight:285000, cost:112000, days:12, status:"Completed", date:"2024-01-15",
    from:[1.3521,103.8198], to:[51.9244,4.4777] },
  { id:2,  vessel:"MV Pacific Dawn",   voyage:"VO-2402", route:"Shanghai → Los Angeles",  charterer:"CMA CGM",       freight:320000, cost:135000, days:14, status:"Completed", date:"2024-02-20",
    from:[31.2304,121.4737], to:[33.7405,-118.2775] },
  { id:3,  vessel:"MV Atlantic Breeze",voyage:"VO-2403", route:"Jebel Ali → Hamburg",     charterer:"Hapag-Lloyd",   freight:198000, cost: 88000, days:10, status:"Completed", date:"2024-03-12",
    from:[25.0034,55.0612], to:[53.5511,9.9937] },
  { id:4,  vessel:"MV Indian Horizon", voyage:"VO-2404", route:"Mumbai → Singapore",      charterer:"ONE",           freight:145000, cost: 62000, days: 7, status:"Completed", date:"2024-04-08",
    from:[19.0760,72.8777], to:[1.3521,103.8198] },
  { id:5,  vessel:"MV Ocean Star",     voyage:"VO-2405", route:"Rotterdam → New York",    charterer:"Maersk Line",   freight:265000, cost:105000, days:11, status:"Ongoing",   date:"2024-05-18",
    from:[51.9244,4.4777], to:[40.7128,-74.0060] },
  { id:6,  vessel:"MV Pacific Dawn",   voyage:"VO-2406", route:"Busan → Long Beach",      charterer:"Evergreen",     freight:298000, cost:122000, days:13, status:"Completed", date:"2024-06-22",
    from:[35.1796,129.0756], to:[33.7701,-118.1937] },
  { id:7,  vessel:"MV Atlantic Breeze",voyage:"VO-2407", route:"Antwerp → Santos",        charterer:"Hapag-Lloyd",   freight:212000, cost: 95000, days:12, status:"Completed", date:"2024-07-14",
    from:[51.2194,4.4025], to:[-23.9608,-46.3336] },
  { id:8,  vessel:"MV Indian Horizon", voyage:"VO-2408", route:"Chennai → Port Klang",    charterer:"MSC",           freight:132000, cost: 58000, days: 6, status:"Ongoing",   date:"2024-08-30",
    from:[13.0827,80.2707], to:[3.1390,101.6869] },
  { id:9,  vessel:"MV Ocean Star",     voyage:"VO-2409", route:"Singapore → Sydney",      charterer:"CMA CGM",       freight:240000, cost:101000, days:10, status:"Completed", date:"2024-09-11",
    from:[1.3521,103.8198], to:[-33.8688,151.2093] },
  { id:10, vessel:"MV Pacific Dawn",   voyage:"VO-2410", route:"Tokyo → Vancouver",       charterer:"MSC",           freight:275000, cost:118000, days:12, status:"Completed", date:"2024-10-05",
    from:[35.6762,139.6503], to:[49.2827,-123.1207] }
];

// Data tahun lalu (untuk YoY) — hanya angka agregat
const lastYearData = {
  avgTce: 16200,
  revenue: 2450000,
  cost: 1150000,
  voyages: 36
};

/* =========================================================
   UTIL: Format angka
   ========================================================= */
const fmtUSD = n => '$' + Math.round(n).toLocaleString('en-US');
const fmtUSDShort = n => {
  if (n >= 1e6) return '$' + (n/1e6).toFixed(2) + 'M';
  if (n >= 1e3) return '$' + (n/1e3).toFixed(1) + 'K';
  return '$' + n;
};
const calcTce = v => (v.freight - v.cost) / v.days;

/* =========================================================
   STATE
   ========================================================= */
let filteredVoyages = [...voyages];
let dt;                  // DataTable instance
let trendChart, costChart, chartererChart;
let map, mapMarkers = [];

/* =========================================================
   INIT: isi dropdown charterer
   ========================================================= */
const uniqueCharterers = [...new Set(voyages.map(v => v.charterer))].sort();
const filterCharterer = document.getElementById('filterCharterer');
uniqueCharterers.forEach(c => {
  filterCharterer.innerHTML += `<option>${c}</option>`;
});

/* =========================================================
   RENDER TABLE (DataTables)
   ========================================================= */
function renderTable(data) {
  const tbody = document.getElementById('tceTableBody');
  tbody.innerHTML = '';

  let totalRev = 0, totalCost = 0, totalDays = 0;

  data.forEach((v, i) => {
    const tce = calcTce(v);
    totalRev += v.freight;
    totalCost += v.cost;
    totalDays += v.days;

    const statusBadge = v.status === "Completed"
      ? '<span class="badge badge-success">Completed</span>'
      : '<span class="badge badge-warning">Ongoing</span>';

    const tceBadge = tce >= 15000
      ? `<span class="badge badge-profit">${Math.round(tce).toLocaleString('en-US')}</span>`
      : `<span class="badge badge-loss">${Math.round(tce).toLocaleString('en-US')}</span>`;

    tbody.innerHTML += `
      <tr>
        <td>${i+1}</td>
        <td><strong>${v.vessel}</strong></td>
        <td><span class="badge badge-secondary">${v.voyage}</span></td>
        <td>${v.route}</td>
        <td>${v.charterer}</td>
        <td class="text-right" data-order="${v.freight}">${v.freight.toLocaleString('en-US')}</td>
        <td class="text-right" data-order="${v.cost}">${v.cost.toLocaleString('en-US')}</td>
        <td class="text-right">${v.days}</td>
        <td class="text-right font-weight-bold" data-order="${tce}">${tceBadge}</td>
        <td class="text-center">${statusBadge}</td>
      </tr>`;
  });

  document.getElementById('totalRevenue').innerText = totalRev.toLocaleString('en-US');
  document.getElementById('totalCost').innerText    = totalCost.toLocaleString('en-US');
  document.getElementById('totalDays').innerText    = totalDays;
  document.getElementById('avgTce').innerText       = totalDays ? fmtUSD((totalRev - totalCost) / totalDays) : '$0';
  document.getElementById('voyageCount').innerText  = data.length + ' Voyages';

  // Refresh DataTable
  if (dt) {
    dt.destroy();
  }
  dt = $('#tceTable').DataTable({
    order: [[8, 'desc']],
    pageLength: 5,
    lengthMenu: [[5, 10, 25, -1], [5, 10, 25, 'All']],
    language: {
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_ data",
      info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
      infoEmpty: "Tidak ada data",
      infoFiltered: "(difilter dari _MAX_ total)",
      zeroRecords: "Tidak ditemukan",
      paginate: { first:"Awal", last:"Akhir", next:"›", previous:"‹" }
    },
    columnDefs: [
      { targets: [5,6,8], type: 'num' }
    ]
  });

  return { totalRev, totalCost, totalDays };
}

/* =========================================================
   HITUNG & RENDER KPI + YoY
   ========================================================= */
function updateKPI(data) {
  let totalRev = 0, totalCost = 0, totalDays = 0;
  data.forEach(v => { totalRev += v.freight; totalCost += v.cost; totalDays += v.days; });

  const avgTce = totalDays ? (totalRev - totalCost) / totalDays : 0;

  document.getElementById('kpiAvgTce').innerText  = fmtUSD(avgTce);
  document.getElementById('kpiRevenue').innerText = fmtUSDShort(totalRev);
  document.getElementById('kpiCost').innerText    = fmtUSDShort(totalCost);
  document.getElementById('kpiVoyages').innerText = data.length;

  // YoY comparison
  const yoyAvg  = ((avgTce - lastYearData.avgTce) / lastYearData.avgTce) * 100;
  const yoyRev  = ((totalRev - lastYearData.revenue) / lastYearData.revenue) * 100;
  const yoyCost = ((totalCost - lastYearData.cost) / lastYearData.cost) * 100;
  const yoyVoy  = ((data.length - lastYearData.voyages) / lastYearData.voyages) * 100;

  setTrend('kpiAvgTceTrend', yoyAvg, 'vs last year');
  setTrend('kpiRevenueTrend', yoyRev, 'vs last year');
  setTrend('kpiCostTrend', yoyCost, 'vs last year', true); // cost turun = bagus
  setTrend('kpiVoyagesTrend', yoyVoy, 'vs last year');

  // YoY cards
  const yoyContainer = document.getElementById('yoyContainer');
  yoyContainer.innerHTML = `
    ${yoyCard('Avg TCE / Day', fmtUSD(avgTce), fmtUSD(lastYearData.avgTce), yoyAvg, false)}
    ${yoyCard('Total Revenue', fmtUSDShort(totalRev), fmtUSDShort(lastYearData.revenue), yoyRev, false)}
    ${yoyCard('Total Cost', fmtUSDShort(totalCost), fmtUSDShort(lastYearData.cost), yoyCost, true)}
    ${yoyCard('Total Voyages', data.length, lastYearData.voyages, yoyVoy, false)}
  `;
}

function setTrend(elId, pct, suffix = '', invertGood = false) {
  const el = document.getElementById(elId);
  const isUp = pct >= 0;
  const isGood = invertGood ? !isUp : isUp;
  const icon = isUp ? 'fa-arrow-up' : 'fa-arrow-down';
  const color = isGood ? '#d4ffd4' : '#ffd4d4';
  el.innerHTML = `<i class="fas ${icon}" style="color:${color}"></i> ${Math.abs(pct).toFixed(1)}% ${suffix}`;
}

function yoyCard(label, current, previous, pct, invertGood) {
  const isUp = pct >= 0;
  const isGood = invertGood ? !isUp : isUp;
  const cls = isGood ? 'positive' : 'negative';
  const deltaCls = isUp ? 'up' : 'down';
  const icon = isUp ? 'fa-arrow-up' : 'fa-arrow-down';
  return `
    <div class="yoy-card ${cls}">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="yoy-label">${label}</div>
          <div class="yoy-value">${current}</div>
          <div class="charterer-value">sebelumnya: ${previous}</div>
        </div>
        <div class="yoy-delta ${deltaCls}">
          <i class="fas ${icon}"></i> ${Math.abs(pct).toFixed(1)}%
        </div>
      </div>
    </div>`;
}

/* =========================================================
   CHARTERER BREAKDOWN
   ========================================================= */
function updateCharterer(data) {
  const grouped = {};
  data.forEach(v => {
    if (!grouped[v.charterer]) grouped[v.charterer] = { revenue:0, cost:0, days:0, voyages:0 };
    grouped[v.charterer].revenue += v.freight;
    grouped[v.charterer].cost    += v.cost;
    grouped[v.charterer].days    += v.days;
    grouped[v.charterer].voyages += 1;
  });

  Object.keys(grouped).forEach(k => {
    const d = grouped[k];
    d.tce = d.days ? (d.revenue - d.cost) / d.days : 0;
  });

  const sorted = Object.entries(grouped).sort((a,b) => b[1].tce - a[1].tce);
  const list = document.getElementById('chartererList');
  list.innerHTML = '';

  if (sorted.length === 0) {
    list.innerHTML = '<p class="text-muted small mb-0">Tidak ada data</p>';
    return;
  }

  const maxTce = sorted[0][1].tce;

  sorted.forEach(([name, d]) => {
    const pct = maxTce ? (d.tce / maxTce) * 100 : 0;
    const color = pct > 80 ? 'bg-success' : (pct > 60 ? 'bg-primary' : (pct > 40 ? 'bg-warning' : 'bg-danger'));
    list.innerHTML += `
      <div class="charterer-row">
        <div class="d-flex justify-content-between align-items-center mb-1">
          <div>
            <div class="charterer-name"><i class="fas fa-building mr-1 text-primary"></i>${name}</div>
            <div class="charterer-value">${d.voyages} voyage(s) · ${fmtUSDShort(d.revenue)} revenue</div>
          </div>
          <div class="text-right">
            <div class="font-weight-bold">${fmtUSD(d.tce)}</div>
            <div class="charterer-value">per day</div>
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar ${color}" style="width:${pct}%"></div>
        </div>
      </div>`;
  });

  // Bar chart
  const labels = sorted.map(c => c[0]);
  const values = sorted.map(c => Math.round(c[1].tce));

  if (chartererChart) chartererChart.destroy();
  chartererChart = new Chart(document.getElementById('chartererChart'), {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'TCE per Day',
        data: values,
        backgroundColor: ['#1e5fbf','#28a745','#ff8c00','#6f42c1','#17a2b8','#dc3545'],
        borderRadius: 6
      }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: { callbacks: { label: ctx => fmtUSD(ctx.parsed.y) + ' / day' } }
      },
      scales: {
        y: { beginAtZero: true, ticks: { callback: val => '$' + (val/1000) + 'k' } },
        x: { grid: { display: false } }
      }
    }
  });
}

/* =========================================================
   CHART TREND (per Vessel)
   ========================================================= */
function renderTrendChart() {
  const ctx = document.getElementById('tceTrendChart').getContext('2d');
  if (trendChart) trendChart.destroy();

  trendChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
      datasets: [
        {
          label: 'MV Ocean Star',
          data: [16200, 16800, 17500, 18200, 17900, 18500, 19200, 19800, 19500, 20100, 20800, 21200],
          borderColor: '#1e5fbf',
          backgroundColor: 'rgba(30,95,191,0.08)',
          borderWidth: 2, tension: 0.3, fill: true, pointRadius: 3
        },
        {
          label: 'MV Pacific Dawn',
          data: [15400, 15900, 16200, 16800, 17100, 17600, 17300, 18100, 18600, 18900, 19200, 19800],
          borderColor: '#28a745',
          backgroundColor: 'rgba(40,167,69,0.05)',
          borderWidth: 2, tension: 0.3, fill: true, pointRadius: 3
        },
        {
          label: 'MV Atlantic Breeze',
          data: [14800, 15200, 15600, 16100, 15800, 16400, 16900, 17200, 17600, 17900, 18300, 18700],
          borderColor: '#ff8c00',
          backgroundColor: 'rgba(255,140,0,0.05)',
          borderWidth: 2, tension: 0.3, fill: true, pointRadius: 3
        }
      ]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: {
        legend: { position: 'top', labels: { boxWidth: 12, font: { size: 11 } } },
        tooltip: { callbacks: { label: ctx => ctx.dataset.label + ': ' + fmtUSD(ctx.parsed.y) } }
      },
      scales: {
        y: { beginAtZero: false, ticks: { callback: val => '$' + (val/1000) + 'k' } },
        x: { grid: { display: false } }
      }
    }
  });
}

/* =========================================================
   CHART KOMPOSISI BIAYA
   ========================================================= */
function renderCostChart(data) {
  const ctx = document.getElementById('costChart').getContext('2d');
  if (costChart) costChart.destroy();

  // Hitung proporsi biaya berdasarkan data yang difilter
  let totalCost = 0;
  data.forEach(v => totalCost += v.cost);

  const bunker  = totalCost * 0.42;
  const port    = totalCost * 0.24;
  const canal   = totalCost * 0.19;
  const agency  = totalCost * 0.15;

  costChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Bunker', 'Port Charges', 'Canal Dues', 'Agency & Commission'],
      datasets: [{
        data: [Math.round(bunker), Math.round(port), Math.round(canal), Math.round(agency)],
        backgroundColor: ['#1e5fbf', '#28a745', '#ff8c00', '#6f42c1'],
        borderWidth: 2, borderColor: '#fff'
      }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: {
        legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 }, padding: 12 } },
        tooltip: { callbacks: { label: ctx => ctx.label + ': ' + fmtUSD(ctx.parsed) } }
      },
      cutout: '62%'
    }
  });
}

/* =========================================================
   PETA LEAFLET
   ========================================================= */
function initMap() {
  map = L.map('map', { scrollWheelZoom: false }).setView([20, 30], 2);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 18
  }).addTo(map);

  setTimeout(() => map.invalidateSize(), 200);
}

function updateMap(data) {
  if (!map) return;

  // Hapus marker & line lama
  mapMarkers.forEach(m => map.removeLayer(m));
  mapMarkers = [];

  if (data.length === 0) {
    document.getElementById('mapInfo').innerText = 'Tidak ada route untuk ditampilkan';
    return;
  }

  const bounds = [];

  data.forEach(v => {
    if (!v.from || !v.to) return;

    // Marker origin
    const mFrom = L.circleMarker(v.from, {
      radius: 6, color: '#1e5fbf', fillColor: '#1e5fbf', fillOpacity: 0.9, weight: 2
    }).addTo(map).bindPopup(`
      <div style="font-size:12px;">
        <strong>${v.vessel}</strong> — ${v.voyage}<br>
        <b>From:</b> ${v.route.split('→')[0].trim()}<br>
        <b>Charterer:</b> ${v.charterer}<br>
        <b>TCE/Day:</b> ${fmtUSD(calcTce(v))}
      </div>`);

    // Marker destination
    const mTo = L.circleMarker(v.to, {
      radius: 6, color: '#28a745', fillColor: '#28a745', fillOpacity: 0.9, weight: 2
    }).addTo(map).bindPopup(`
      <div style="font-size:12px;">
        <strong>${v.vessel}</strong> — ${v.voyage}<br>
        <b>To:</b> ${v.route.split('→')[1]?.trim() || ''}<br>
        <b>Status:</b> ${v.status}
      </div>`);

    // Garis route (curve sederhana via polyline)
    const line = L.polyline([v.from, v.to], {
      color: v.status === 'Completed' ? '#1e5fbf' : '#ff8c00',
      weight: 2, opacity: 0.7, dashArray: v.status === 'Completed' ? '' : '6,6'
    }).addTo(map).bindPopup(`
      <div style="font-size:12px;">
        <strong>${v.route}</strong><br>
        ${v.charterer} · ${v.days} days<br>
        TCE: <b>${fmtUSD(calcTce(v))}/day</b>
      </div>`);

    mapMarkers.push(mFrom, mTo, line);
    bounds.push(v.from, v.to);
  });

  if (bounds.length) {
    map.fitBounds(bounds, { padding: [40, 40] });
  }
  document.getElementById('mapInfo').innerText = `${data.length} route ditampilkan`;
}

/* =========================================================
   FILTER
   ========================================================= */
function applyFilter() {
  const vessel = document.getElementById('filterVessel').value;
  const charterer = document.getElementById('filterCharterer').value;
  const status = document.getElementById('filterStatus').value;
  const dateFrom = document.getElementById('filterDateFrom').value;
  const dateTo = document.getElementById('filterDateTo').value;

  filteredVoyages = voyages.filter(v => {
    if (vessel && v.vessel !== vessel) return false;
    if (charterer && v.charterer !== charterer) return false;
    if (status && v.status !== status) return false;
    if (dateFrom && v.date < dateFrom) return false;
    if (dateTo && v.date > dateTo) return false;
    return true;
  });

  refreshAll();
  showToast(`Filter diterapkan — ${filteredVoyages.length} voyage ditemukan`, 'info');
}

function resetFilter() {
  document.getElementById('filterVessel').value = '';
  document.getElementById('filterCharterer').value = '';
  document.getElementById('filterStatus').value = '';
  document.getElementById('filterDateFrom').value = '2024-01-01';
  document.getElementById('filterDateTo').value = '2024-12-31';
  filteredVoyages = [...voyages];
  refreshAll();
  showToast('Filter di-reset', 'info');
}

/* =========================================================
   MASTER REFRESH
   ========================================================= */
function refreshAll() {
  renderTable(filteredVoyages);
  updateKPI(filteredVoyages);
  updateCharterer(filteredVoyages);
  renderCostChart(filteredVoyages);
  updateMap(filteredVoyages);
}

/* =========================================================
   TOAST
   ========================================================= */
function showToast(msg, type = 'success') {
  const toast = document.getElementById('toast');
  toast.classList.remove('error', 'info');
  if (type === 'error') toast.classList.add('error');
  else if (type === 'info') toast.classList.add('info');

  document.getElementById('toastMsg').innerText = msg;

  const icon = toast.querySelector('i');
  icon.className = type === 'error' ? 'fas fa-exclamation-circle mr-2'
                  : type === 'info'  ? 'fas fa-info-circle mr-2'
                  : 'fas fa-check-circle mr-2';

  toast.classList.add('show');
  clearTimeout(toast._t);
  toast._t = setTimeout(() => toast.classList.remove('show'), 3000);
}

/* =========================================================
   DARK MODE
   ========================================================= */
const btnDark = document.getElementById('btnDarkMode');
function toggleDark(force) {
  const isDark = force !== undefined ? force : !document.body.classList.contains('dark-mode');
  document.body.classList.toggle('dark-mode', isDark);
  btnDark.innerHTML = isDark
    ? '<i class="fas fa-sun mr-1"></i>Light Mode'
    : '<i class="fas fa-moon mr-1"></i>Dark Mode';
  localStorage.setItem('tce-darkmode', isDark ? 'on' : 'off');

  // Update grid chart
  const gridColor = isDark ? '#2c313a' : '#eef1f5';
  [trendChart, chartererChart].forEach(c => {
    if (c && c.options.scales && c.options.scales.y) {
      c.options.scales.y.grid = c.options.scales.y.grid || {};
      c.options.scales.y.grid.color = gridColor;
      c.update();
    }
  });
}
btnDark.addEventListener('click', () => toggleDark());
if (localStorage.getItem('tce-darkmode') === 'on') toggleDark(true);

/* =========================================================
   EXPORT CSV
   ========================================================= */
document.getElementById('btnExportCsv').addEventListener('click', () => {
  const headers = ['#','Vessel','Voyage','Route','Charterer','Gross Freight','Voyage Cost','Hire Days','TCE/Day','Status','Date'];
  const rows = filteredVoyages.map((v, i) => [
    i+1, v.vessel, v.voyage, v.route, v.charterer,
    v.freight, v.cost, v.days, Math.round(calcTce(v)), v.status, v.date
  ]);

  const csv = [headers, ...rows]
    .map(r => r.map(c => `"${String(c).replace(/"/g,'""')}"`).join(','))
    .join('\n');

  const blob = new Blob(['\ufeff' + csv], { type: 'text/csv;charset=utf-8;' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'TCE_Report_' + new Date().toISOString().slice(0,10) + '.csv';
  a.click();
  URL.revokeObjectURL(url);
  showToast('CSV berhasil di-download');
});

/* =========================================================
   EXPORT PDF
   ========================================================= */
document.getElementById('btnExportPdf').addEventListener('click', () => {
  const overlay = document.getElementById('loadingOverlay');
  document.getElementById('loadingText').innerText = 'Generating PDF...';
  overlay.classList.add('active');

  setTimeout(() => {
    try {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF('p', 'pt', 'a4');
      const pageW = doc.internal.pageSize.width;

      // ---- Hitung totals
      let totalRev = 0, totalCost = 0, totalDays = 0;
      filteredVoyages.forEach(v => {
        totalRev += v.freight; totalCost += v.cost; totalDays += v.days;
      });
      const avgTce = totalDays ? (totalRev - totalCost) / totalDays : 0;

      // ---- Header
      doc.setFillColor(11, 61, 145);
      doc.rect(0, 0, pageW, 70, 'F');
      doc.setTextColor(255,255,255);
      doc.setFontSize(18); doc.setFont('helvetica', 'bold');
      doc.text('TCE REPORT DASHBOARD', 40, 32);
      doc.setFontSize(10); doc.setFont('helvetica', 'normal');
      doc.text('Time Charter Equivalent Analysis — Maritime Chartering Division', 40, 52);

      doc.setTextColor(60,60,60);
      doc.setFontSize(9);
      doc.text('Generated: ' + new Date().toLocaleString('id-ID'), pageW - 40, 32, { align:'right' });
      doc.text('Voyages: ' + filteredVoyages.length, pageW - 40, 48, { align:'right' });

      // ---- Summary
      doc.setFontSize(12); doc.setFont('helvetica','bold');
      doc.setTextColor(11,61,145);
      doc.text('SUMMARY', 40, 100);
      doc.setDrawColor(220,220,220); doc.line(40, 105, pageW - 40, 105);

      const summary = [
        ['Average TCE / Day', fmtUSD(avgTce)],
        ['Total Gross Revenue', fmtUSD(totalRev)],
        ['Total Voyage Cost', fmtUSD(totalCost)],
        ['Total Hire Days', totalDays + ' days'],
        ['Total Voyages', filteredVoyages.length]
      ];
      doc.setFontSize(10); doc.setFont('helvetica','normal'); doc.setTextColor(60,60,60);
      summary.forEach((s, i) => {
        const y = 125 + i*17;
        doc.text(s[0], 50, y);
        doc.setFont('helvetica','bold');
        doc.text(s[1], 240, y);
        doc.setFont('helvetica','normal');
      });

      // ---- Detail Table
      doc.setFontSize(12); doc.setFont('helvetica','bold');
      doc.setTextColor(11,61,145);
      doc.text('VOYAGE DETAIL', 40, 225);

      const tableRows = filteredVoyages.map((v, i) => [
        (i+1).toString(), v.vessel, v.voyage, v.route, v.charterer,
        v.freight.toLocaleString('en-US'),
        v.cost.toLocaleString('en-US'),
        v.days.toString(),
        fmtUSD(calcTce(v)),
        v.status
      ]);

      doc.autoTable({
        startY: 235,
        head: [['#','Vessel','Voyage','Route','Charterer','Freight ($)','Cost ($)','Days','TCE/Day','Status']],
        body: tableRows,
        theme: 'striped',
        headStyles: { fillColor: [11,61,145], textColor: 255, fontSize: 8, halign: 'center' },
        bodyStyles: { fontSize: 7.5 },
        columnStyles: {
          0: { halign:'center', cellWidth: 22 },
          5: { halign:'right' }, 6: { halign:'right' },
          7: { halign:'center' },
          8: { halign:'right', fontStyle:'bold' },
          9: { halign:'center' }
        },
        alternateRowStyles: { fillColor: [245,247,250] },
        margin: { left: 30, right: 30 }
      });

      // ---- Charterer Breakdown
      let finalY = doc.lastAutoTable.finalY + 25;
      if (finalY > doc.internal.pageSize.height - 150) { doc.addPage(); finalY = 60; }

      doc.setFontSize(12); doc.setFont('helvetica','bold');
      doc.setTextColor(11,61,145);
      doc.text('CHARTERER BREAKDOWN', 40, finalY);

      const grouped = {};
      filteredVoyages.forEach(v => {
        if (!grouped[v.charterer]) grouped[v.charterer] = { revenue:0, cost:0, days:0, voyages:0 };
        grouped[v.charterer].revenue += v.freight;
        grouped[v.charterer].cost += v.cost;
        grouped[v.charterer].days += v.days;
        grouped[v.charterer].voyages += 1;
      });
      const sorted = Object.entries(grouped)
        .map(([name, d]) => [name, d, d.days ? (d.revenue - d.cost)/d.days : 0])
        .sort((a,b) => b[2] - a[2]);

      doc.autoTable({
        startY: finalY + 10,
        head: [['Charterer','Voyages','Revenue ($)','Cost ($)','Days','Avg TCE/Day']],
        body: sorted.map(([name, d, tce]) => [
          name, d.voyages, fmtUSD(d.revenue), fmtUSD(d.cost), d.days, fmtUSD(tce)
        ]),
        theme: 'grid',
        headStyles: { fillColor: [11,61,145], textColor: 255, fontSize: 9, halign:'center' },
        bodyStyles: { fontSize: 8.5 },
        columnStyles: {
          1: { halign:'center' }, 2: { halign:'right' },
          3: { halign:'right' }, 4: { halign:'center' },
          5: { halign:'right', fontStyle:'bold' }
        },
        margin: { left: 30, right: 30 }
      });

      // ---- YoY Section
      finalY = doc.lastAutoTable.finalY + 25;
      if (finalY > doc.internal.pageSize.height - 100) { doc.addPage(); finalY = 60; }

      doc.setFontSize(12); doc.setFont('helvetica','bold');
      doc.setTextColor(11,61,145);
      doc.text('YEAR OVER YEAR COMPARISON', 40, finalY);

      const yoyAvg  = ((avgTce - lastYearData.avgTce) / lastYearData.avgTce) * 100;
      const yoyRev  = ((totalRev - lastYearData.revenue) / lastYearData.revenue) * 100;
      const yoyCost = ((totalCost - lastYearData.cost) / lastYearData.cost) * 100;

      doc.autoTable({
        startY: finalY + 10,
        head: [['Metric','Current','Last Year','Change (%)']],
        body: [
          ['Avg TCE/Day', fmtUSD(avgTce), fmtUSD(lastYearData.avgTce), yoyAvg.toFixed(2) + '%'],
          ['Total Revenue', fmtUSD(totalRev), fmtUSD(lastYearData.revenue), yoyRev.toFixed(2) + '%'],
          ['Total Cost', fmtUSD(totalCost), fmtUSD(lastYearData.cost), yoyCost.toFixed(2) + '%'],
          ['Total Voyages', filteredVoyages.length, lastYearData.voyages,
            (((filteredVoyages.length - lastYearData.voyages) / lastYearData.voyages) * 100).toFixed(2) + '%']
        ],
        theme: 'grid',
        headStyles: { fillColor: [11,61,145], textColor: 255, fontSize: 9 },
        bodyStyles: { fontSize: 8.5 },
        margin: { left: 30, right: 30 }
      });

      // ---- Footer tiap halaman
      const pageCount = doc.internal.getNumberOfPages();
      for (let i = 1; i <= pageCount; i++) {
        doc.setPage(i);
        doc.setFontSize(8); doc.setTextColor(150,150,150); doc.setFont('helvetica','italic');
        doc.text('TCE Report Dashboard — Confidential Internal Document', 40, doc.internal.pageSize.height - 20);
        doc.text('Page ' + i + ' of ' + pageCount, pageW - 40, doc.internal.pageSize.height - 20, { align:'right' });
      }

      doc.save('TCE_Report_' + new Date().toISOString().slice(0,10) + '.pdf');
      showToast('PDF berhasil di-download');
    } catch (err) {
      console.error(err);
      showToast('Gagal generate PDF: ' + err.message, 'error');
    } finally {
      overlay.classList.remove('active');
    }
  }, 400);
});

/* =========================================================
   EMAIL
   ========================================================= */
document.getElementById('btnSendEmail').addEventListener('click', () => {
  const to = document.getElementById('emailTo').value.trim();
  const cc = document.getElementById('emailCc').value.trim();
  const subject = document.getElementById('emailSubject').value.trim();
  const body = document.getElementById('emailBody').value;
  const attach = document.getElementById('emailAttachPdf').checked;

  if (!to) {
    showToast('Alamat email penerima wajib diisi', 'error');
    return;
  }

  // Hitung summary
  let totalRev = 0, totalCost = 0, totalDays = 0;
  filteredVoyages.forEach(v => {
    totalRev += v.freight; totalCost += v.cost; totalDays += v.days;
  });
  const avgTce = totalDays ? (totalRev - totalCost) / totalDays : 0;

  let finalBody = body;
  if (attach) {
    finalBody += `\n\n--- RINGKASAN TCE ---\n` +
      `Total Voyages    : ${filteredVoyages.length}\n` +
      `Avg TCE / Day    : ${fmtUSD(avgTce)}\n` +
      `Total Revenue    : ${fmtUSD(totalRev)}\n` +
      `Total Cost       : ${fmtUSD(totalCost)}\n` +
      `Total Hire Days  : ${totalDays} days\n` +
      `Generated        : ${new Date().toLocaleString('id-ID')}\n`;
  }

  const mailto = `mailto:${encodeURIComponent(to)}` +
    `?cc=${encodeURIComponent(cc)}` +
    `&subject=${encodeURIComponent(subject)}` +
    `&body=${encodeURIComponent(finalBody)}`;

  window.location.href = mailto;

  $('#emailModal').modal('hide');
  showToast('Email client dibuka. Jangan lupa attach PDF-nya ya!', 'info');
});

document.getElementById('btnEmailQuick').addEventListener('click', () => {
  $('#emailModal').modal('show');
});

/* =========================================================
   EVENT BINDING
   ========================================================= */
document.getElementById('btnApply').addEventListener('click', applyFilter);
document.getElementById('btnReset').addEventListener('click', resetFilter);

// Auto apply saat dropdown berubah
['filterVessel','filterCharterer','filterStatus'].forEach(id => {
  document.getElementById(id).addEventListener('change', applyFilter);
});

/* =========================================================
   INIT
   ========================================================= */
// document.getElementById('genDate').innerText = new Date().toLocaleString('id-ID', {
//   day:'2-digit', month:'long', year:'numeric', hour:'2-digit', minute:'2-digit'
// });

initMap();
renderTrendChart();
refreshAll();
</script>

</body>
</html>