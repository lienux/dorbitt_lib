<style>
  body {
    background-color: #f4f6f9;
    font-family: 'Segoe UI', Tahoma, sans-serif;
  }

  .kpi-card {
    transition: transform 0.2s, box-shadow 0.2s;
    border-radius: 8px;
  }
  .kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.12) !important;
  }

  .border-left-primary   { border-left: 4px solid #4e73df !important; }
  .border-left-success   { border-left: 4px solid #1cc88a !important; }
  .border-left-danger    { border-left: 4px solid #e74a3b !important; }
  .border-left-warning   { border-left: 4px solid #f6c23e !important; }
  .border-left-info      { border-left: 4px solid #36b9cc !important; }
  .border-left-secondary { border-left: 4px solid #858796 !important; }

  .text-xs { font-size: .72rem; letter-spacing: .05em; }

  .card { border: none; border-radius: 8px; }
  .card-header { border-bottom: 1px solid #e3e6f0; background: #fff; }

  .navbar-brand { font-weight: 600; letter-spacing: .5px; }

  /* Heatmap */
  .heatmap-table { border-collapse: collapse; font-size: 11px; width: 100%; }
  .heatmap-table th, .heatmap-table td {
    border: 1px solid #e3e6f0;
    padding: 6px 8px;
    text-align: center;
    white-space: nowrap;
  }
  .heatmap-table th { background: #f8f9fc; font-weight: 600; position: sticky; top: 0; z-index: 2; }
  .heatmap-table td.vessel-col {
    text-align: left;
    background: #f8f9fc;
    font-weight: 600;
    position: sticky;
    left: 0;
    z-index: 1;
  }
  .heatmap-cell {
    font-weight: 600;
    color: #fff;
    border-radius: 4px;
    padding: 3px 8px;
    display: inline-block;
    min-width: 48px;
  }

  /* Status badge */
  .status-badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
  }
  .status-good { background: #d4edda; color: #155724; }
  .status-warn { background: #fff3cd; color: #856404; }
  .status-bad  { background: #f8d7da; color: #721c24; }

  /* Alert */
  .alert-item {
    padding: 10px 14px;
    border-radius: 6px;
    border-left: 4px solid;
    margin-bottom: 8px;
    background: #fff;
  }
  .alert-item.critical { border-color: #e74a3b; background: #fdf2f2; }
  .alert-item.warning  { border-color: #f6c23e; background: #fffbf0; }
  .alert-item .vessel-name { font-weight: 700; }

  /* Table */
  .table thead th {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .03em;
    color: #6c757d;
    border-top: none;
  }

  .chart-container { position: relative; height: 280px; }
  #loading { font-size: 12px; }

  /* Print friendly */
  @media print {
    .navbar, .btn, #filterForm, footer, #loading { display: none !important; }
    body { background: #fff; }
    .card { box-shadow: none !important; border: 1px solid #ddd; page-break-inside: avoid; }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-3">
    <a class="navbar-brand" href="#">
        <i class="fas fa-ship"></i> Fleet Utilization Monitoring
    </a>
    <div class="ml-auto text-white">
        <small class="mr-3"><i class="fas fa-clock"></i> <span id="serverTime"></span></small>
        <span class="badge badge-success" id="connectionStatus">
            <i class="fas fa-circle"></i> Offline Mode
        </span>
    </div>
</nav>

<!-- ===================== NAVBAR ===================== -->
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <div class="form-row align-items-end">
            <div class="col-md-2 mb-2">
                <label class="small font-weight-bold mb-1">Dari Tanggal</label>
                <input type="date" class="form-control form-control-sm" id="from">
            </div>
            <div class="col-md-2 mb-2">
                <label class="small font-weight-bold mb-1">Sampai Tanggal</label>
                <input type="date" class="form-control form-control-sm" id="to">
            </div>
            <div class="col-md-3 mb-2">
                <label class="small font-weight-bold mb-1">Vessel</label>
                <select class="form-control form-control-sm" id="vessel_id">
                    <option value="">— Semua Vessel —</option>
                </select>
            </div>
            <div class="col-md-5 mb-2">
                <button type="button" id="btnRefresh" class="btn btn-primary btn-sm">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
                <button type="button" id="btnReset" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-undo"></i> Reset
                </button>
                <button type="button" id="btnQuick30" class="btn btn-outline-info btn-sm">30 Hari</button>
                <button type="button" id="btnQuick90" class="btn btn-outline-info btn-sm">90 Hari</button>
                <button type="button" id="btnQuickYTD" class="btn btn-outline-info btn-sm">YTD</button>
                <button type="button" id="btnExport" class="btn btn-success btn-sm">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>
                <button type="button" id="btnPrint" class="btn btn-outline-dark btn-sm">
                    <i class="fas fa-print"></i> Print
                </button>
                <span id="loading" class="ml-2 text-muted" style="display:none;">
                    <i class="fas fa-spinner fa-spin"></i> Memuat...
                </span>
            </div>
        </div>
    </div>
</div>

<!-- ============ KPI CARDS ============ -->
<div class="row" id="kpiCards">
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
        <div class="card kpi-card border-left-primary shadow-sm h-100">
            <div class="card-body py-3">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Fleet Utilization</div>
                <div class="h5 mb-0 font-weight-bold" id="kpi_utilization">—</div>
                <small class="text-muted" id="kpi_utilization_sub">Operating / Available</small>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
        <div class="card kpi-card border-left-success shadow-sm h-100">
            <div class="card-body py-3">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Availability</div>
                <div class="h5 mb-0 font-weight-bold" id="kpi_availability">—</div>
                <small class="text-muted" id="kpi_availability_sub">Excl. downtime</small>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
        <div class="card kpi-card border-left-danger shadow-sm h-100">
            <div class="card-body py-3">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Downtime</div>
                <div class="h5 mb-0 font-weight-bold" id="kpi_downtime">—</div>
                <small class="text-muted" id="kpi_downtime_sub">Target ≤ 5%</small>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
      <div class="card kpi-card border-left-warning shadow-sm h-100">
        <div class="card-body py-3">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Idle Time</div>
          <div class="h5 mb-0 font-weight-bold" id="kpi_idle">—</div>
          <small class="text-muted" id="kpi_idle_sub">Target ≤ 10%</small>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
      <div class="card kpi-card border-left-info shadow-sm h-100">
        <div class="card-body py-3">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Commercial Util</div>
          <div class="h5 mb-0 font-weight-bold" id="kpi_commercial">—</div>
          <small class="text-muted" id="kpi_commercial_sub">Laden only</small>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
      <div class="card kpi-card border-left-secondary shadow-sm h-100">
        <div class="card-body py-3">
          <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Operating Hours</div>
          <div class="h5 mb-0 font-weight-bold" id="kpi_hours">—</div>
          <small class="text-muted" id="kpi_hours_sub">&nbsp;</small>
        </div>
      </div>
    </div>
</div>

<!-- ============ CHART ROW 1 ============ -->
<div class="row">
<div class="col-lg-8 mb-3">
  <div class="card shadow-sm h-100">
    <div class="card-header font-weight-bold">
      <i class="fas fa-chart-line text-primary"></i> Tren Utilisasi Bulanan
    </div>
    <div class="card-body">
      <div class="chart-container"><canvas id="trendChart"></canvas></div>
    </div>
  </div>
</div>
<div class="col-lg-4 mb-3">
  <div class="card shadow-sm h-100">
    <div class="card-header font-weight-bold">
      <i class="fas fa-chart-pie text-success"></i> Status Breakdown
    </div>
    <div class="card-body">
      <div class="chart-container"><canvas id="statusChart"></canvas></div>
    </div>
  </div>
</div>
</div>

<!-- ============ CHART ROW 2 ============ -->
<div class="row">
<div class="col-lg-6 mb-3">
  <div class="card shadow-sm h-100">
    <div class="card-header font-weight-bold">
      <i class="fas fa-ship text-info"></i> Utilisasi per Vessel
    </div>
    <div class="card-body">
      <div class="chart-container" style="height:320px;">
        <canvas id="vesselChart"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-6 mb-3">
  <div class="card shadow-sm h-100">
    <div class="card-header font-weight-bold">
      <i class="fas fa-th text-warning"></i> Heatmap Utilisasi (Vessel × Bulan)
    </div>
    <div class="card-body" style="overflow:auto; max-height:360px;">
      <div id="heatmapContainer">
        <p class="text-muted mb-0">Memuat data...</p>
      </div>
    </div>
  </div>
</div>
</div>

<!-- ============ TABLE ============ -->
<div class="card shadow-sm mb-3">
<div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
  <span><i class="fas fa-table text-secondary"></i> Detail Kinerja Vessel</span>
  <span class="badge badge-secondary" id="tableCount">0 vessel</span>
</div>
<div class="card-body p-0">
  <div class="table-responsive">
    <table class="table table-sm table-hover mb-0" id="reportTable">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>Vessel</th>
          <th>Type</th>
          <th class="text-right">Operating Hrs</th>
          <th class="text-right">Idle Hrs</th>
          <th class="text-right">Downtime Hrs</th>
          <th class="text-right">Utilisasi</th>
          <th class="text-center">Status</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <tr><td colspan="8" class="text-center text-muted py-4">Memuat data...</td></tr>
      </tbody>
    </table>
  </div>
</div>
</div>

<!-- ============ ALERTS ============ -->
<div class="card shadow-sm">
<div class="card-header font-weight-bold">
  <i class="fas fa-bell text-danger"></i> Alerts / Peringatan
  <span class="badge badge-danger ml-2" id="alertCount">0</span>
</div>
<div class="card-body" id="alertsContainer">
  <p class="text-muted mb-0">Tidak ada peringatan.</p>
</div>
</div>

<!-- ===================== LIBS ===================== -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
/* ============================================================
   FLEET UTILIZATION DASHBOARD - 100% Standalone (No DB, No API)
   Semua data digenerate di sisi client.
   ============================================================ */
$(function () {

  /* ============ MASTER DATA VESSEL ============ */
  const VESSELS = [
    { vessel_id: 1, vessel_name: 'MV Ocean Star',     vessel_type: 'Tanker',    dwt: 50000 },
    { vessel_id: 2, vessel_name: 'MV Sea Lion',       vessel_type: 'Bulk',      dwt: 75000 },
    { vessel_id: 3, vessel_name: 'MV Pacific Dawn',   vessel_type: 'Container', dwt: 80000 },
    { vessel_id: 4, vessel_name: 'MV Golden Wave',    vessel_type: 'Tanker',    dwt: 45000 },
    { vessel_id: 5, vessel_name: 'MV Northern Light', vessel_type: 'Bulk',      dwt: 60000 },
    { vessel_id: 6, vessel_name: 'MV Blue Horizon',   vessel_type: 'Container', dwt: 70000 },
    { vessel_id: 7, vessel_name: 'MV Red Anchor',     vessel_type: 'Tanker',    dwt: 55000 },
    { vessel_id: 8, vessel_name: 'MV Silver Tide',    vessel_type: 'Bulk',      dwt: 65000 }
  ];

  const ACTIVITY_TYPES = ['LADEN','BALLAST','IDLE','STANDBY','DRYDOCK','BREAKDOWN'];
  const PALETTE = {
    LADEN: '#2ECC71',
    BALLAST: '#3498DB',
    IDLE: '#F1C40F',
    STANDBY: '#E67E22',
    DRYDOCK: '#E74A3B',
    BREAKDOWN: '#7F8C8D'
  };

  let charts = { trend: null, status: null, vessel: null };
  let lastReportData = [];   // untuk export CSV

  /* ============ HELPER ============ */
  function toDateInput(d) { return d.toISOString().split('T')[0]; }

  function rand(min, max) { return Math.random() * (max - min) + min; }
  function randInt(min, max) { return Math.floor(rand(min, max + 1)); }

  function fmtNum(n, dec = 1) {
    return Number(n).toLocaleString('id-ID', { maximumFractionDigits: dec });
  }

  function colorByPct(pct) {
    if (pct >= 85) return '#1cc88a';
    if (pct >= 70) return '#f6c23e';
    return '#e74a3b';
  }

  function badgeByPct(pct) {
    if (pct >= 85) return '<span class="status-badge status-good">Baik</span>';
    if (pct >= 70) return '<span class="status-badge status-warn">Cukup</span>';
    return '<span class="status-badge status-bad">Rendah</span>';
  }

  function heatColor(pct) {
    if (pct >= 90) return '#1cc88a';
    if (pct >= 80) return '#7bd88f';
    if (pct >= 70) return '#f6c23e';
    if (pct >= 60) return '#f39c12';
    if (pct >= 40) return '#e67e22';
    return '#e74a3b';
  }

  function showLoading(show) { $('#loading').toggle(show); }

  function getFilters() {
    return {
      from:      $('#from').val(),
      to:        $('#to').val(),
      vessel_id: $('#vessel_id').val()
    };
  }

  function periodMonths(from, to) {
    const list = [];
    const d = new Date(from);
    const end = new Date(to);
    d.setDate(1);
    while (d <= end) {
      list.push(d.toISOString().slice(0, 7));
      d.setMonth(d.getMonth() + 1);
      if (list.length > 24) break; // safety
    }
    return list.length ? list : [to.slice(0, 7)];
  }

  /* ============================================================
     SIMULASI DATA GENERATOR (menggantikan query database)
     ============================================================ */

  /**
   * Generate data aktivitas harian untuk 1 vessel dalam 1 rentang waktu.
   * Return array: [{date, type, hours}, ...]
   */
  function generateActivities(vesselId, from, to) {
    const rows = [];
    const d = new Date(from);
    const end = new Date(to);
    // seed pseudo-random per vessel agar konsisten tiap refresh
    let seed = vesselId * 7919;
    const rnd = () => { seed = (seed * 9301 + 49297) % 233280; return seed / 233280; };

    while (d <= end) {
      const r = rnd();
      let type;
      if (r < 0.55)      type = 'LADEN';
      else if (r < 0.75) type = 'BALLAST';
      else if (r < 0.85) type = 'IDLE';
      else if (r < 0.90) type = 'STANDBY';
      else if (r < 0.96) type = 'DRYDOCK';
      else               type = 'BREAKDOWN';

      rows.push({
        vessel_id: vesselId,
        date: toDateInput(d),
        type: type,
        hours: 24
      });
      d.setDate(d.getDate() + 1);
    }
    return rows;
  }

  /**
   * Kumpulkan semua aktivitas untuk seluruh vessel (difilter).
   */
  function getAllActivities() {
    const f = getFilters();
    const from = f.from || toDateInput(new Date(Date.now() - 90 * 86400000));
    const to   = f.to   || toDateInput(new Date());
    const vesselIds = f.vessel_id
      ? [parseInt(f.vessel_id)]
      : VESSELS.map(v => v.vessel_id);

    let all = [];
    vesselIds.forEach(id => {
      all = all.concat(generateActivities(id, from, to));
    });
    return { rows: all, from, to, vesselIds };
  }

  /* ============ DATA BUILDERS ============ */

  function buildSummary() {
    const { rows } = getAllActivities();
    let total = 0, operating = 0, laden = 0, idle = 0, downtime = 0;

    rows.forEach(r => {
      total += r.hours;
      if (r.type === 'LADEN' || r.type === 'BALLAST') operating += r.hours;
      if (r.type === 'LADEN') laden += r.hours;
      if (r.type === 'IDLE') idle += r.hours;
      if (r.type === 'DRYDOCK' || r.type === 'BREAKDOWN') downtime += r.hours;
    });

    return {
      utilization_pct:  total ? +(100 * operating / total).toFixed(2) : 0,
      availability_pct: total ? +(100 * (total - downtime) / total).toFixed(2) : 0,
      downtime_pct:     total ? +(100 * downtime / total).toFixed(2) : 0,
      idle_pct:         total ? +(100 * idle / total).toFixed(2) : 0,
      commercial_pct:   total ? +(100 * laden / total).toFixed(2) : 0,
      operating_hours:  operating,
      total_hours:      total
    };
  }

  function buildTrend() {
    const { rows } = getAllActivities();
    const bucket = {};

    rows.forEach(r => {
      const period = r.date.slice(0, 7); // YYYY-MM
      if (!bucket[period]) bucket[period] = { operating: 0, total: 0 };
      bucket[period].total += r.hours;
      if (r.type === 'LADEN' || r.type === 'BALLAST') bucket[period].operating += r.hours;
    });

    return Object.keys(bucket).sort().map(p => ({
      period: p,
      utilization_pct: +(100 * bucket[p].operating / bucket[p].total).toFixed(2)
    }));
  }

  function buildStatusBreakdown() {
    const { rows } = getAllActivities();
    const bucket = {};
    rows.forEach(r => {
      bucket[r.type] = (bucket[r.type] || 0) + r.hours;
    });
    return Object.keys(bucket).map(k => ({
      activity_type: k,
      total_hours: +bucket[k].toFixed(1)
    })).sort((a, b) => b.total_hours - a.total_hours);
  }

  function buildByVessel() {
    const { rows, vesselIds } = getAllActivities();
    const map = {};

    vesselIds.forEach(id => {
      map[id] = {
        vessel_id: id,
        vessel_name: VESSELS.find(v => v.vessel_id === id).vessel_name,
        vessel_type: VESSELS.find(v => v.vessel_id === id).vessel_type,
        total_hours: 0, operating_hours: 0, idle_hours: 0, downtime_hours: 0
      };
    });

    rows.forEach(r => {
      const m = map[r.vessel_id];
      m.total_hours += r.hours;
      if (r.type === 'LADEN' || r.type === 'BALLAST') m.operating_hours += r.hours;
      if (r.type === 'IDLE') m.idle_hours += r.hours;
      if (r.type === 'DRYDOCK' || r.type === 'BREAKDOWN') m.downtime_hours += r.hours;
    });

    return Object.values(map).map(m => ({
      vessel_id: m.vessel_id,
      vessel_name: m.vessel_name,
      vessel_type: m.vessel_type,
      total_hours: +m.total_hours.toFixed(1),
      operating_hours: +m.operating_hours.toFixed(1),
      idle_hours: +m.idle_hours.toFixed(1),
      downtime_hours: +m.downtime_hours.toFixed(1),
      utilization_pct: m.total_hours ? +(100 * m.operating_hours / m.total_hours).toFixed(2) : 0
    })).sort((a, b) => b.utilization_pct - a.utilization_pct);
  }

  function buildHeatmap() {
    const { rows, vesselIds } = getAllActivities();
    const map = {};

    rows.forEach(r => {
      const key = r.vessel_id + '|' + r.date.slice(0, 7);
      if (!map[key]) map[key] = { operating: 0, total: 0 };
      map[key].total += r.hours;
      if (r.type === 'LADEN' || r.type === 'BALLAST') map[key].operating += r.hours;
    });

    const result = [];
    vesselIds.forEach(id => {
      const vName = VESSELS.find(v => v.vessel_id === id).vessel_name;
      Object.keys(map).forEach(k => {
        const [vid, period] = k.split('|');
        if (parseInt(vid) === id) {
          result.push({
            vessel_name: vName,
            period: period,
            utilization_pct: +(100 * map[k].operating / map[k].total).toFixed(2)
          });
        }
      });
    });
    return result;
  }

  function buildAlerts() {
    return buildByVessel()
      .map(r => {
        const total = r.total_hours || 1;
        const dtPct = +(100 * r.downtime_hours / total).toFixed(2);
        const alerts = [];
        if (r.utilization_pct < 70) {
          alerts.push({
            vessel_name: r.vessel_name,
            type: 'LOW_UTILIZATION',
            severity: r.utilization_pct < 55 ? 'CRITICAL' : 'WARNING',
            value: r.utilization_pct + '%',
            message: 'Utilisasi di bawah 70%'
          });
        }
        if (dtPct > 5) {
          alerts.push({
            vessel_name: r.vessel_name,
            type: 'HIGH_DOWNTIME',
            severity: dtPct > 10 ? 'CRITICAL' : 'WARNING',
            value: dtPct + '%',
            message: 'Downtime melebihi 5%'
          });
        }
        return alerts;
      })
      .flat();
  }

  /* ============ RENDERERS ============ */

  function renderSummary() {
    const d = buildSummary();
    $('#kpi_utilization').text(d.utilization_pct + '%').css('color', colorByPct(d.utilization_pct));
    $('#kpi_availability').text(d.availability_pct + '%').css('color', colorByPct(d.availability_pct));
    $('#kpi_downtime').text(d.downtime_pct + '%')
      .css('color', d.downtime_pct > 5 ? '#e74a3b' : '#1cc88a');
    $('#kpi_idle').text(d.idle_pct + '%')
      .css('color', d.idle_pct > 10 ? '#e74a3b' : '#f6c23e');
    $('#kpi_commercial').text(d.commercial_pct + '%').css('color', colorByPct(d.commercial_pct));
    $('#kpi_hours').text(fmtNum(d.operating_hours) + ' h');
    $('#kpi_hours_sub').text('dari ' + fmtNum(d.total_hours) + ' h');
  }

  function renderTrend() {
    const rows = buildTrend();
    const labels = rows.map(r => r.period);
    const data   = rows.map(r => r.utilization_pct);

    if (charts.trend) charts.trend.destroy();
    charts.trend = new Chart(document.getElementById('trendChart'), {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Utilisasi (%)',
          data: data,
          borderColor: '#4e73df',
          backgroundColor: 'rgba(78,115,223,0.15)',
          fill: true,
          tension: 0.3,
          pointBackgroundColor: data.map(v => colorByPct(v)),
          pointRadius: 5,
          pointHoverRadius: 7
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: { callbacks: { label: ctx => 'Utilisasi: ' + ctx.parsed.y + '%' } }
        },
        scales: {
          y: {
            beginAtZero: true, max: 100,
            ticks: { callback: v => v + '%' },
            grid: { color: '#eef0f4' }
          },
          x: { grid: { display: false } }
        }
      }
    });
  }

  function renderStatus() {
    const rows = buildStatusBreakdown();
    const labels = rows.map(r => r.activity_type);
    const data   = rows.map(r => r.total_hours);
    const colors = labels.map(l => PALETTE[l] || '#cccccc');

    if (charts.status) charts.status.destroy();
    charts.status = new Chart(document.getElementById('statusChart'), {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: data,
          backgroundColor: colors,
          borderWidth: 2,
          borderColor: '#fff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '60%',
        plugins: {
          legend: { position: 'bottom', labels: { boxWidth: 12, fontSize: 11 } },
          tooltip: {
            callbacks: {
              label: function (ctx) {
                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                const pct = ((ctx.parsed / total) * 100).toFixed(1);
                return ctx.label + ': ' + fmtNum(ctx.parsed) + ' h (' + pct + '%)';
              }
            }
          }
        }
      }
    });
  }

  function renderByVessel() {
    const rows = buildByVessel();
    const labels = rows.map(r => r.vessel_name);
    const data   = rows.map(r => r.utilization_pct);
    const colors = data.map(v => colorByPct(v));

    if (charts.vessel) charts.vessel.destroy();
    charts.vessel = new Chart(document.getElementById('vesselChart'), {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Utilisasi (%)',
          data: data,
          backgroundColor: colors,
          borderRadius: 4,
          maxBarThickness: 24
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: { callbacks: { label: ctx => 'Utilisasi: ' + ctx.parsed.x + '%' } }
        },
        scales: {
          x: {
            beginAtZero: true, max: 100,
            ticks: { callback: v => v + '%' },
            grid: { color: '#eef0f4' }
          },
          y: { grid: { display: false } }
        }
      }
    });
  }

  function renderHeatmap() {
    const rows = buildHeatmap();
    if (!rows.length) {
      $('#heatmapContainer').html('<p class="text-muted mb-0">Tidak ada data.</p>');
      return;
    }

    const vessels = [...new Set(rows.map(r => r.vessel_name))];
    const periods = [...new Set(rows.map(r => r.period))].sort();

    const map = {};
    rows.forEach(r => { map[r.vessel_name + '|' + r.period] = r.utilization_pct; });

    let html = '<table class="heatmap-table"><thead><tr><th>Vessel</th>';
    periods.forEach(p => html += '<th>' + p + '</th>');
    html += '</tr></thead><tbody>';

    vessels.forEach(v => {
      html += '<tr><td class="vessel-col">' + v + '</td>';
      periods.forEach(p => {
        const val = map[v + '|' + p];
        if (val === undefined) {
          html += '<td>—</td>';
        } else {
          html += '<td><span class="heatmap-cell" style="background:' + heatColor(val) + ';">' +
                  val.toFixed(1) + '%</span></td>';
        }
      });
      html += '</tr>';
    });
    html += '</tbody></table>';
    $('#heatmapContainer').html(html);
  }

  function renderTable() {
    const rows = buildByVessel();
    lastReportData = rows;

    if (!rows.length) {
      $('#tableBody').html('<tr><td colspan="8" class="text-center text-muted py-4">Tidak ada data.</td></tr>');
      $('#tableCount').text('0 vessel');
      return;
    }

    let html = '';
    rows.forEach((r, i) => {
      const pct = r.utilization_pct;
      html += `
        <tr>
          <td>${i + 1}</td>
          <td class="font-weight-bold">${r.vessel_name}</td>
          <td><span class="badge badge-light border">${r.vessel_type}</span></td>
          <td class="text-right">${fmtNum(r.operating_hours)}</td>
          <td class="text-right">${fmtNum(r.idle_hours)}</td>
          <td class="text-right">${fmtNum(r.downtime_hours)}</td>
          <td class="text-right font-weight-bold" style="color:${colorByPct(pct)};">${pct.toFixed(1)}%</td>
          <td class="text-center">${badgeByPct(pct)}</td>
        </tr>`;
    });
    $('#tableBody').html(html);
    $('#tableCount').text(rows.length + ' vessel');
  }

  function renderAlerts() {
    const rows = buildAlerts();
    $('#alertCount').text(rows.length);

    if (!rows.length) {
      $('#alertsContainer').html(
        '<p class="text-muted mb-0"><i class="fas fa-check-circle text-success"></i> Tidak ada peringatan.</p>'
      );
      return;
    }

    let html = '';
    rows.forEach(a => {
      const cls = a.severity === 'CRITICAL' ? 'critical' : 'warning';
      const ico = a.severity === 'CRITICAL' ? 'exclamation-triangle' : 'exclamation-circle';
      const badge = a.severity === 'CRITICAL' ? 'danger' : 'warning';
      html += `
        <div class="alert-item ${cls}">
          <i class="fas fa-${ico} mr-2"></i>
          <span class="vessel-name">${a.vessel_name}</span>
          <span class="badge badge-${badge} ml-2">${a.severity}</span>
          <span class="ml-2">${a.message} — <strong>${a.value}</strong></span>
        </div>`;
    });
    $('#alertsContainer').html(html);
  }

  function renderAll() {
    showLoading(true);
    setTimeout(() => {
      renderSummary();
      renderTrend();
      renderStatus();
      renderByVessel();
      renderHeatmap();
      renderTable();
      renderAlerts();
      showLoading(false);
    }, 250);
  }

  /* ============ INIT ============ */
  function initFilters() {
    const today = new Date();
    const from  = new Date();
    from.setDate(today.getDate() - 90);
    $('#from').val(toDateInput(from));
    $('#to').val(toDateInput(today));

    // isi dropdown vessel
    VESSELS.forEach(v => {
      $('#vessel_id').append(`<option value="${v.vessel_id}">${v.vessel_name}</option>`);
    });
  }

  function initClock() {
    $('#year').text(new Date().getFullYear());
    const tick = () => $('#serverTime').text(new Date().toLocaleString('id-ID'));
    tick();
    setInterval(tick, 1000);
  }

  /* ============ EXPORT CSV ============ */
  function exportCSV() {
    if (!lastReportData.length) { alert('Tidak ada data untuk diekspor.'); return; }

    let csv = 'No,Vessel,Type,Operating Hours,Idle Hours,Downtime Hours,Utilization %,Status\n';
    lastReportData.forEach((r, i) => {
      const status = r.utilization_pct >= 85 ? 'Baik'
                   : r.utilization_pct >= 70 ? 'Cukup' : 'Rendah';
      csv += [
        i + 1,
        `"${r.vessel_name}"`,
        r.vessel_type,
        r.operating_hours,
        r.idle_hours,
        r.downtime_hours,
        r.utilization_pct,
        status
      ].join(',') + '\n';
    });

    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'fleet_utilization_' + toDateInput(new Date()) + '.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
  }

  /* ============ EVENTS ============ */
  $('#btnRefresh').on('click', renderAll);

  $('#btnReset').on('click', function () {
    initFilters();
    $('#vessel_id').val('');
    renderAll();
  });

  $('#btnQuick30').on('click', function () {
    const to = new Date();
    const from = new Date(); from.setDate(to.getDate() - 30);
    $('#from').val(toDateInput(from));
    $('#to').val(toDateInput(to));
    renderAll();
  });

  $('#btnQuick90').on('click', function () {
    const to = new Date();
    const from = new Date(); from.setDate(to.getDate() - 90);
    $('#from').val(toDateInput(from));
    $('#to').val(toDateInput(to));
    renderAll();
  });

  $('#btnQuickYTD').on('click', function () {
    const to = new Date();
    const from = new Date(to.getFullYear(), 0, 1);
    $('#from').val(toDateInput(from));
    $('#to').val(toDateInput(to));
    renderAll();
  });

  $('#btnExport').on('click', exportCSV);
  $('#btnPrint').on('click', function () { window.print(); });

  $('#vessel_id, #from, #to').on('change', renderAll);

  /* ============ START ============ */
  initClock();
  initFilters();
  renderAll();

});
</script>
