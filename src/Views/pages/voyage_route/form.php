<!-- Leaflet Map CSS -->
<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" /> -->

<style>
    /* ============================================
       VOYAGE ROUTE MAP - Waypoint Visualization
       ============================================ */
    .vr-map-wrapper {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        margin-bottom: 1rem;
    }

    .vr-map-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f3f9;
    }

    .vr-map-header .vr-icon {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2c0074, #4a1a9e);
        color: #fff;
        border-radius: 6px;
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .vr-map-header h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.9rem;
        color: #2c0074;
    }

    .vr-map-header .map-status {
        margin-left: auto;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        background: #f1f3f9;
        color: #858796;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .vr-map-header .map-status.loaded {
        background: #d1f2eb;
        color: #0e8f71;
    }

    .vr-map-header .map-status.empty {
        background: #fdeaea;
        color: #dc3545;
    }

    /* Map container */
    #vr_route_map {
        height: 360px;
        width: 100%;
        border-radius: 8px;
        background: #eef1f7;
        position: relative;
        z-index: 1;
    }

    /* Empty state */
    .vr-map-empty {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #858796;
        background: linear-gradient(135deg, #f8f9fc 0%, #eef1f7 100%);
        border-radius: 8px;
        z-index: 2;
        text-align: center;
        padding: 1rem;
        pointer-events: none;
    }

    .vr-map-empty i {
        font-size: 2rem;
        color: #2c0074;
        opacity: 0.35;
        margin-bottom: 0.5rem;
    }

    .vr-map-empty p {
        margin: 0;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .vr-map-empty small {
        font-size: 0.7rem;
        opacity: 0.8;
    }

    /* Route info chips */
    .vr-route-info {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px dashed #e3e6f0;
    }

    .vr-route-info .info-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.35rem 0.7rem;
        background: #f8f9fc;
        border-radius: 20px;
        font-size: 0.72rem;
        color: #5a5c69;
    }

    .vr-route-info .info-chip i {
        color: #2c0074;
        font-size: 0.7rem;
    }

    .vr-route-info .info-chip strong {
        color: #2c0074;
        margin-left: 0.15rem;
    }

    .vr-route-info .info-chip.from {
        background: #e8f4fd;
        border: 1px solid #cfe7f5;
    }

    .vr-route-info .info-chip.from i {
        color: #0d6efd;
    }

    .vr-route-info .info-chip.to {
        background: #fdeaea;
        border: 1px solid #f5cfcf;
    }

    .vr-route-info .info-chip.to i {
        color: #dc3545;
    }

    .vr-route-info .info-chip.waypoint {
        background: #fff8e1;
        border: 1px solid #ffe8a1;
    }

    .vr-route-info .info-chip.waypoint i {
        color: #f0ad4e;
    }

    .vr-route-info .info-chip.distance {
        background: #f3e8fd;
        border: 1px solid #e0cff5;
    }

    .vr-route-info .info-chip.distance i {
        color: #6f42c1;
    }

    .vr-route-info .info-chip.eta {
        background: #e8fdf5;
        border: 1px solid #c3e6db;
    }

    .vr-route-info .info-chip.eta i {
        color: #0e8f71;
    }

    /* Custom marker icons */
    .vr-map-marker {
        background: transparent;
        border: none;
    }

    .vr-map-marker .pin {
        width: 26px;
        height: 26px;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .vr-map-marker .pin i {
        transform: rotate(45deg);
        color: #fff;
        font-size: 0.65rem;
    }

    .vr-map-marker.start .pin {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
    }

    .vr-map-marker.end .pin {
        background: linear-gradient(135deg, #dc3545, #b02a37);
    }

    /* Waypoint marker (numbered circle) */
    .vr-waypoint-marker {
        background: transparent;
        border: none;
    }

    .vr-waypoint-marker .wp-dot {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f0ad4e, #e08c1e);
        border: 3px solid #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 0.65rem;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    /* Leaflet controls override */
    .leaflet-control-zoom {
        border-radius: 8px !important;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15) !important;
        border: none !important;
    }

    .leaflet-control-zoom a {
        background: #fff !important;
        color: #2c0074 !important;
        font-weight: 700 !important;
        border-bottom: 1px solid #eef1f7 !important;
    }

    .leaflet-control-zoom a:hover {
        background: #f8f6ff !important;
    }

    /* Popup styling */
    .leaflet-popup-content-wrapper {
        border-radius: 8px !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15) !important;
    }

    .leaflet-popup-content {
        margin: 0.65rem 0.85rem !important;
        font-family: inherit !important;
    }

    .vr-popup-title {
        font-weight: 700;
        font-size: 0.82rem;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .vr-popup-title.from { color: #0d6efd; }
    .vr-popup-title.to { color: #dc3545; }
    .vr-popup-title.wp { color: #e08c1e; }

    .vr-popup-body {
        font-size: 0.78rem;
        color: #333;
        line-height: 1.4;
    }

    .vr-popup-body .coords {
        font-family: 'Courier New', monospace;
        font-size: 0.72rem;
        color: #666;
        background: #f5f5f5;
        padding: 1px 4px;
        border-radius: 3px;
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        #vr_route_map {
            height: 260px;
        }

        .vr-route-info .info-chip {
            font-size: 0.68rem;
            padding: 0.3rem 0.55rem;
        }
    }
</style>

<!-- Form -->
<div id="form_input"> 
    <div class="row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0" for="name">
                    Name<span class="text-danger small"> *</span>
                </label>
                <div class="col-sm-8">
                    <input type="text" id="name" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Nama Rute" required disabled>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0" for="port_of_loading">
                    Port of Loading<span class="text-danger small"> *</span>
                </label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control is-data-id" id="port_of_loading" data-toggle="tooltip" data-placement="top" title="Pelabuhan Awal" required disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_pelabuhan" type="button" disabled
                                data-inputid="port_of_loading" data-modaltitle="Master Data Port">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0" for="port_of_discharge">
                    Port of Discharge<span class="text-danger small"> *</span>
                </label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control is-data-id" id="port_of_discharge" data-toggle="tooltip" data-placement="top" title="Pelabuhan Akhir" required disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_pelabuhan" type="button" disabled
                                data-inputid="port_of_discharge" data-modaltitle="Master Data Port">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <label class="col-sm-3 col-form-label mb-2 pb-0" for="lintang">
                    Latitude<span class="text-danger small"> *</span>
                </label>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control form-control-sm" id="lintang" name="lintang" placeholder="Deg (°)">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control form-control-sm" id="lintang_menit" name="lintang_menit" placeholder="Menit (')">
                </div>
                <div class="col-md-2 mb-2">
                    <select id="lintang_s" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="">
                        <option value="S" selected>S</option>
                        <option value="N">N</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label mb-2 pb-0" for="bujur">
                    Longitude<span class="text-danger small"> *</span>
                </label>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control form-control-sm" id="bujur" name="bujur" placeholder="Deg (°)">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control form-control-sm" id="bujur_menit" name="bujur_menit" placeholder="Menit (')">
                </div>
                <div class="col-md-2 mb-2">
                    <select id="bujur_e" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="">
                        <option value="E" selected>E</option>
                        <option value="W">W</option>
                    </select>
                </div>
            </div> -->
        </div>

        <div class="col-lg-6 col-sm-12">
            <!-- <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0" for="timezone">
                    Time Zone
                </label>
                <div class="col-sm-9">
                    <input type="text" id="timezone" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Time Zone" disabled>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0" for="draft_limit">
                    Draft Limit
                </label>
                <div class="col-sm-9">
                    <input type="text" id="draft_limit" class="form-control form-control-sm endis" placeholder="" data-toggle="tooltip" data-placement="top" title="Batas Kedalaman" disabled>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label" for="type">Type</label>
                <div class="col-sm-9">
                    <select id="type" class="form-control form-control-sm endis" data-toggle="tooltip" data-placement="top" title="Tipe Pelabuhan" disabled>
                        <option value="" selected disabled>Choose...</option>
                        <option value="1">Loading</option>
                        <option value="2">Discharge</option>
                        <option value="3">Bunker</option>
                    </select>
                </div>
            </div> -->
        </div>

        <div class="col-lg-12 mt-3">
            <nav class="ummu-nav">
                <div class="nav nav-tabs">
                    <button class="nav-link mr-1 py-0 active" id="nav-tab-waypoint" data-toggle="tab" data-target="#nav-waypoint" type="button" role="tab" aria-selected="true">
                        Waypoint
                    </button>
                </div>
            </nav>
            <div class="section-body">
                <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
                    <div class="card-body pt-2">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-waypoint" role="tabpanel">
                                <?= $this->include(config('Vh')->ummuView($dir_views . 'table_waypoint')) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================
             PETA RUTE VOYAGE
             ============================================ -->
            <div class="vr-map-wrapper">
                <div class="vr-map-header">
                    <span class="vr-icon"><i class="fas fa-map-marked-alt"></i></span>
                    <h6>Pratinjau Rute Voyage</h6>
                    <span class="map-status" id="vr_map_status">
                        <i class="fas fa-circle-notch fa-spin"></i> Menunggu data
                    </span>
                </div>

                <div style="position: relative;">
                    <div id="vr_route_map"></div>
                    <div class="vr-map-empty" id="vr_map_empty">
                        <i class="fas fa-route"></i>
                        <p>Rute belum tersedia</p>
                        <small>Pilih Port of Loading & Discharge, lalu tambahkan waypoint</small>
                    </div>
                </div>

                <div class="vr-route-info" id="vr_route_info" style="display:none;">
                    <span class="info-chip from">
                        <i class="fas fa-ship"></i>
                        <span>From:</span> <strong id="vr_from_label">-</strong>
                    </span>
                    <span class="info-chip to">
                        <i class="fas fa-flag-checkered"></i>
                        <span>To:</span> <strong id="vr_to_label">-</strong>
                    </span>
                    <span class="info-chip waypoint">
                        <i class="fas fa-map-pin"></i>
                        <span>Waypoints:</span> <strong id="vr_wp_count">0</strong>
                    </span>
                    <span class="info-chip distance">
                        <i class="fas fa-ruler-horizontal"></i>
                        <span>Total Jarak:</span> <strong id="vr_distance_label">-</strong>
                    </span>
                    <span class="info-chip eta">
                        <i class="fas fa-clock"></i>
                        <span>Estimasi:</span> <strong id="vr_eta_label">-</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalForm_inputWaypoint" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-purple py-2 text-light">
                <h6 class="modal-title"><i class="fal fa-file-contract"></i> <span id="waypoint_modal_title">Form Input Waypoint</span></h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                        <i class="fa-light fa-rectangle-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="alert text-light collapse" id="alert_waypoint_modal"></div>

                <!-- Lintang -->
                <div class="col-lg-12 col-sm-12 text-sm">
                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <label for="waypoint_name" class="text-info mb-0">
                                Nama Waypoint<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="waypoint_name"
                                name="waypoint_name" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="sequence" class="text-info mb-0">
                                Sequence<span class="text-danger">*</span>
                            </label>
                            <input type="number" min="1" max="100" class="form-control form-control-sm" id="sequence"
                                name="sequence" required>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="lintang_sudut" class="text-info mb-0">
                                Lintang (Lat)<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="lintang_sudut" name="lintang_sudut" placeholder="Deg (°)" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lintang_menit" class="text-info mb-0"></label>
                            <input type="text" class="form-control form-control-sm" id="lintang_menit" name="lintang_menit" placeholder="Menit (')" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lintang_arah" class="text-info mb-0"></label>
                            <select id="lintang_arah" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="" required>
                                <option value="S" selected>S</option>
                                <option value="N">N</option>
                            </select>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="bujur_sudut" class="text-info mb-0">
                                Bujur (Lon)<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="bujur_sudut" name="bujur_sudut" placeholder="Deg (°)" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bujur_menit" class="text-info mb-0"></label>
                            <input type="text" class="form-control form-control-sm" id="bujur_menit" name="bujur_menit" placeholder="Menit (')" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="bujur_arah" class="text-info mb-0"></label>
                            <select id="bujur_arah" class="form-control form-control-sm" data-toggle="tooltip" data-placement="top" title="" required>
                                <option value="E" selected>E</option>
                                <option value="W">W</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="haluan" class="text-info mb-0">
                                Haluan (°) <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="haluan"
                                name="haluan" disabled required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="jarak" class="text-info mb-0">
                                Jarak (NM) <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="jarak"
                                name="jarak" disabled required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="jarak" class="text-info mb-0">
                                Total Jarak (NM) <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="total_jarak"
                                name="total_jarak" disabled required>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-sm btn-primary" id="modal_btnSave_hitungKoordinat">
                            <i class="fas fa-sigma"></i>
                            Calculate
                        </button>
                        <button class="btn btn-sm btn-primary" id="modal_btnSave_waypoint">
                            <i class="fas fa-plus-circle"></i> 
                            Save
                        </button>
                        <button class="btn btn-sm btn-danger collapse" id="modal_btnDelete_waypoint">
                            <i class="fas fa-trash-alt"></i> 
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer"></div> -->
        </div>
    </div>
</div>

<!-- <script>
    // ============================================
    // VOYAGE ROUTE MAP - Waypoint Visualization
    // ============================================
    (function () {
        let vrMap = null;
        let vrRouteLayer = null;
        let vrGlowLayer = null;
        let vrMarkers = []; // array of { type, marker }

        const DEFAULT_CENTER = [-2.5, 118.0];
        const DEFAULT_ZOOM = 5;

        // ============================================
        // INIT MAP
        // ============================================
        function initVrMap() {
            if (vrMap) return vrMap;

            const mapEl = document.getElementById('vr_route_map');
            if (!mapEl) return null;

            vrMap = L.map('vr_route_map', {
                center: DEFAULT_CENTER,
                zoom: DEFAULT_ZOOM,
                zoomControl: true,
                attributionControl: false,
                scrollWheelZoom: false,
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                minZoom: 3,
            }).addTo(vrMap);

            L.control.attribution({ position: 'bottomright', prefix: false })
                .addAttribution('&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>')
                .addTo(vrMap);

            // Scroll zoom hanya aktif saat peta diklik
            vrMap.on('click', () => vrMap.scrollWheelZoom.enable());
            vrMap.on('mouseout', () => vrMap.scrollWheelZoom.disable());

            setTimeout(() => vrMap.invalidateSize(), 300);
            return vrMap;
        }

        // ============================================
        // ICON BUILDERS
        // ============================================
        function createPinIcon(type) {
            const cls = type === 'start' ? 'start' : 'end';
            const sym = type === 'start' ? 'fa-ship' : 'fa-flag-checkered';
            return L.divIcon({
                className: 'vr-map-marker ' + cls,
                html: `<div class="pin"><i class="fas ${sym}"></i></div>`,
                iconSize: [26, 26],
                iconAnchor: [13, 26],
                popupAnchor: [0, -26],
            });
        }

        function createWaypointIcon(sequence) {
            return L.divIcon({
                className: 'vr-waypoint-marker',
                html: `<div class="wp-dot">${sequence}</div>`,
                iconSize: [24, 24],
                iconAnchor: [12, 12],
                popupAnchor: [0, -14],
            });
        }

        // ============================================
        // HAVERSINE DISTANCE (km)
        // ============================================
        function haversineDistance(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const toRad = (deg) => (deg * Math.PI) / 180;
            const dLat = toRad(lat2 - lat1);
            const dLon = toRad(lon2 - lon1);
            const a = Math.sin(dLat / 2) ** 2 +
                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                Math.sin(dLon / 2) ** 2;
            return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        }

        // ============================================
        // FORMATTERS
        // ============================================
        function formatDistance(km) {
            if (km < 1) return (km * 1000).toFixed(0) + ' m';
            if (km < 100) return km.toFixed(1) + ' km';
            return km.toFixed(0) + ' km';
        }

        function formatNM(km) {
            return (km / 1.852).toFixed(1) + ' NM';
        }

        function formatETA(km) {
            const speedKnot = 10;
            const speedKmh = speedKnot * 1.852;
            const hours = km / speedKmh;
            if (hours < 1) return (hours * 60).toFixed(0) + ' menit';
            if (hours < 24) return hours.toFixed(1) + ' jam';
            return (hours / 24).toFixed(1) + ' hari';
        }

        // ============================================
        // PARSE KOORDINAT dari format (deg, menit, arah)
        // ============================================
        function parseCoord(deg, minutes, direction) {
            if (deg === null || deg === undefined || deg === '') return null;
            const d = parseFloat(deg) || 0;
            const m = parseFloat(minutes) || 0;
            let value = Math.abs(d) + m / 60;

            if (direction === 'S' || direction === 'W') value = -value;
            return value;
        }

        // ============================================
        // CLEAR ALL LAYERS
        // ============================================
        function clearAll() {
            if (!vrMap) return;

            vrMarkers.forEach(({ marker }) => vrMap.removeLayer(marker));
            vrMarkers = [];

            if (vrRouteLayer) {
                vrMap.removeLayer(vrRouteLayer);
                vrRouteLayer = null;
            }
            if (vrGlowLayer) {
                vrMap.removeLayer(vrGlowLayer);
                vrGlowLayer = null;
            }
        }

        // ============================================
        // SET EMPTY STATE
        // ============================================
        function setEmptyState(message) {
            const emptyEl = document.getElementById('vr_map_empty');
            const statusEl = document.getElementById('vr_map_status');

            if (emptyEl) {
                emptyEl.style.display = 'flex';
                if (message) {
                    emptyEl.querySelector('p').textContent = message;
                }
            }
            if (statusEl) {
                statusEl.className = 'map-status empty';
                statusEl.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + (message || 'Data belum lengkap');
            }

            document.getElementById('vr_route_info').style.display = 'none';
            clearAll();

            if (vrMap) {
                vrMap.setView(DEFAULT_CENTER, DEFAULT_ZOOM, { animate: true });
            }
        }

        // ============================================
        // DRAW ROUTE
        // ============================================
        /**
         * @param {Object} payload
         * @param {Object} payload.from      - { lat, lng, label }
         * @param {Object} payload.to        - { lat, lng, label }
         * @param {Array}  payload.waypoints - [{ lat, lng, label, sequence }]
         */
        function drawRoute(payload) {
            const map = initVrMap();
            if (!map) return;

            clearAll();

            const { from, to, waypoints = [] } = payload;

            // Validasi
            if (!from || from.lat === null || from.lng === null) {
                return setEmptyState('Port of Loading belum diisi');
            }
            if (!to || to.lat === null || to.lng === null) {
                return setEmptyState('Port of Discharge belum diisi');
            }

            // Urutkan waypoint berdasarkan sequence
            const sortedWp = [...waypoints]
                .filter(wp => wp.lat !== null && wp.lng !== null)
                .sort((a, b) => (a.sequence || 0) - (b.sequence || 0));

            // ===== Build titik-titik rute =====
            const routePoints = [
                [from.lat, from.lng],
                ...sortedWp.map(wp => [wp.lat, wp.lng]),
                [to.lat, to.lng],
            ];

            // ===== Marker Start =====
            const mStart = L.marker([from.lat, from.lng], {
                icon: createPinIcon('start'),
                title: 'Port of Loading',
                zIndexOffset: 1000,
            }).addTo(map);
            mStart.bindPopup(`
                <div>
                    <div class="vr-popup-title from"><i class="fas fa-ship"></i> Port of Loading</div>
                    <div class="vr-popup-body">
                        ${from.label || '-'}<br>
                        <span class="coords">${from.lat.toFixed(5)}, ${from.lng.toFixed(5)}</span>
                    </div>
                </div>
            `);
            vrMarkers.push({ type: 'start', marker: mStart });

            // ===== Marker End =====
            const mEnd = L.marker([to.lat, to.lng], {
                icon: createPinIcon('end'),
                title: 'Port of Discharge',
                zIndexOffset: 1000,
            }).addTo(map);
            mEnd.bindPopup(`
                <div>
                    <div class="vr-popup-title to"><i class="fas fa-flag-checkered"></i> Port of Discharge</div>
                    <div class="vr-popup-body">
                        ${to.label || '-'}<br>
                        <span class="coords">${to.lat.toFixed(5)}, ${to.lng.toFixed(5)}</span>
                    </div>
                </div>
            `);
            vrMarkers.push({ type: 'end', marker: mEnd });

            // ===== Waypoint Markers =====
            sortedWp.forEach((wp, idx) => {
                const m = L.marker([wp.lat, wp.lng], {
                    icon: createWaypointIcon(wp.sequence || (idx + 1)),
                    title: wp.label || `Waypoint ${idx + 1}`,
                }).addTo(map);

                m.bindPopup(`
                    <div>
                        <div class="vr-popup-title wp"><i class="fas fa-map-pin"></i> Waypoint ${wp.sequence || (idx + 1)}</div>
                        <div class="vr-popup-body">
                            ${wp.label || '-'}<br>
                            <span class="coords">${wp.lat.toFixed(5)}, ${wp.lng.toFixed(5)}</span>
                        </div>
                    </div>
                `);

                vrMarkers.push({ type: 'waypoint', marker: m });
            });

            // ===== Polyline Rute =====
            if (routePoints.length >= 2) {
                // Glow layer
                vrGlowLayer = L.polyline(routePoints, {
                    color: '#00c9a7',
                    weight: 8,
                    opacity: 0.15,
                    lineCap: 'round',
                    lineJoin: 'round',
                }).addTo(map);

                // Main line
                vrRouteLayer = L.polyline(routePoints, {
                    color: '#2c0074',
                    weight: 3,
                    opacity: 0.9,
                    dashArray: '12, 10',
                    lineCap: 'round',
                    lineJoin: 'round',
                }).addTo(map);
            }

            // ===== Hitung jarak =====
            let totalKm = 0;
            for (let i = 0; i < routePoints.length - 1; i++) {
                totalKm += haversineDistance(
                    routePoints[i][0], routePoints[i][1],
                    routePoints[i + 1][0], routePoints[i + 1][1]
                );
            }

            // ===== Fit bounds =====
            const bounds = L.latLngBounds(routePoints);
            map.fitBounds(bounds, {
                padding: [50, 50],
                maxZoom: 8,
                animate: true,
                duration: 0.8,
            });

            // ===== Update UI =====
            document.getElementById('vr_from_label').textContent = from.label || '-';
            document.getElementById('vr_to_label').textContent = to.label || '-';
            document.getElementById('vr_wp_count').textContent = sortedWp.length;
            document.getElementById('vr_distance_label').textContent = formatDistance(totalKm) + ' (' + formatNM(totalKm) + ')';
            document.getElementById('vr_eta_label').textContent = '~' + formatETA(totalKm) + ' @10 knot';

            document.getElementById('vr_route_info').style.display = 'flex';
            document.getElementById('vr_map_empty').style.display = 'none';

            const statusEl = document.getElementById('vr_map_status');
            statusEl.className = 'map-status loaded';
            statusEl.innerHTML = '<i class="fas fa-check-circle"></i> Rute ditampilkan';
        }

        // ============================================
        // PUBLIC API
        // ============================================
        window.VrRouteMap = {
            init: initVrMap,
            clear: () => setEmptyState('Rute belum tersedia'),
            empty: setEmptyState,
            parseCoord: parseCoord,

            /**
             * Render rute dari data form + waypoint table
             * @param {Object} opts
             * @param {Function} opts.getPortCoord - fn(portId) => {lat, lng, label} | null
             */
            renderFromForm: function (opts = {}) {
                const map = initVrMap();
                if (!map) return;

                // Ambil Port of Loading & Discharge
                const polVal = $('#port_of_loading').val();
                const podVal = $('#port_of_discharge').val();

                const fromCoord = opts.getPortCoord ? opts.getPortCoord(polVal) : null;
                const toCoord = opts.getPortCoord ? opts.getPortCoord(podVal) : null;

                const from = fromCoord
                    ? { ...fromCoord, label: fromCoord.label || polVal }
                    : null;
                const to = toCoord
                    ? { ...toCoord, label: toCoord.label || podVal }
                    : null;

                // Ambil waypoint dari tabel
                const waypoints = [];
                const $table = $('#tbWaypoint');
                if ($table.length && $.fn.DataTable && $.fn.DataTable.isDataTable($table)) {
                    const dt = $table.DataTable();
                    dt.rows().every(function () {
                        const d = this.data();
                        if (!d) return;

                        // Coba beberapa nama field yang umum
                        const latDeg = d.lintang_sudut ?? d.lintang ?? d.lat_deg ?? d.latitude ?? null;
                        const latMin = d.lintang_menit ?? d.lat_min ?? null;
                        const latDir = d.lintang_arah ?? d.lintang_s ?? d.lat_dir ?? 'S';

                        const lngDeg = d.bujur_sudut ?? d.bujur ?? d.lon_deg ?? d.longitude ?? null;
                        const lngMin = d.bujur_menit ?? d.lon_min ?? null;
                        const lngDir = d.bujur_arah ?? d.bujur_e ?? d.lon_dir ?? 'E';

                        const lat = parseCoord(latDeg, latMin, latDir);
                        const lng = parseCoord(lngDeg, lngMin, lngDir);

                        if (lat !== null && lng !== null) {
                            waypoints.push({
                                lat, lng,
                                sequence: parseInt(d.sequence) || (waypoints.length + 1),
                                label: d.waypoint_name || d.name || `Waypoint ${waypoints.length + 1}`,
                            });
                        }
                    });
                }

                // Jika tidak ada port, kosongkan
                if (!from && !to) {
                    return setEmptyState('Port of Loading & Discharge belum diisi');
                }
                if (!from) {
                    return setEmptyState('Port of Loading belum diisi');
                }
                if (!to) {
                    return setEmptyState('Port of Discharge belum diisi');
                }

                drawRoute({ from, to, waypoints });
            },
        };

        // ============================================
        // AUTO-INIT
        // ============================================
        document.addEventListener('DOMContentLoaded', function () {
            initVrMap();

            // Saat tab Form aktif, paksa peta untuk invalidate size
            const formTab = document.getElementById('nav-tab-form');
            if (formTab) {
                formTab.addEventListener('shown.bs.tab', function () {
                    setTimeout(() => vrMap && vrMap.invalidateSize(), 200);
                });
            }
        });

        document.addEventListener('click', function (e) {
            if (e.target.closest('#nav-tab-form')) {
                setTimeout(() => vrMap && vrMap.invalidateSize(), 300);
            }
        });
    })();
</script> -->

<script>
// ============================================
// VOYAGE ROUTE - WAYPOINT MAP PREVIEW
// ============================================
(function () {
    'use strict';

    let vrMap = null;
    let vrRouteLayer = null;
    let vrGlowLayer = null;
    let vrMarkers = [];
    let vrIsLoadedFromUrl = false;

    const DEFAULT_CENTER = [-4.5, 112.0];
    const DEFAULT_ZOOM = 5;

    // ============================================
    // PARSE KOORDINAT FORMAT: "03-00.350S" / "114-54.200E"
    // ============================================
    function parseCoordinate(str) {
        if (!str || typeof str !== 'string') return null;

        // Format: DD-MM.mmmH atau DDD-MM.mmmH
        // Contoh: "03-00.350S", "114-54.200E"
        const regex = /^(\d{1,3})-(\d{1,2}(?:\.\d+)?)([NSEWnsew])$/;
        const match = str.trim().match(regex);

        if (!match) {
            console.warn('[VR Map] Format koordinat tidak dikenal:', str);
            return null;
        }

        const degrees = parseFloat(match[1]);
        const minutes = parseFloat(match[2]);
        const hemisphere = match[3].toUpperCase();

        // Konversi ke decimal degrees
        let decimal = degrees + (minutes / 60);

        // Negatif untuk S dan W
        if (hemisphere === 'S' || hemisphere === 'W') {
            decimal = -decimal;
        }

        return decimal;
    }

    // Parse full coordinate pair dari waypoint
    function parseWaypointCoords(wp) {
        // Prioritas 1: coba parse dari field lintang & bujur (format DM)
        let lat = null;
        let lng = null;

        if (wp.lintang) lat = parseCoordinate(wp.lintang);
        if (wp.bujur) lng = parseCoordinate(wp.bujur);

        // Prioritas 2: coba dari field sudut/menit/arah (jika ada)
        if (lat === null && wp.lintang_sudut !== null && wp.lintang_sudut !== undefined) {
            const deg = parseFloat(wp.lintang_sudut) || 0;
            const min = parseFloat(wp.lintang_menit) || 0;
            const arah = (wp.lintang_arah || 'S').toUpperCase();
            lat = deg + (min / 60);
            if (arah === 'S') lat = -lat;
        }

        if (lng === null && wp.bujur_sudut !== null && wp.bujur_sudut !== undefined) {
            const deg = parseFloat(wp.bujur_sudut) || 0;
            const min = parseFloat(wp.bujur_menit) || 0;
            const arah = (wp.bujur_arah || 'E').toUpperCase();
            lng = deg + (min / 60);
            if (arah === 'W') lng = -lng;
        }

        if (lat === null || lng === null || isNaN(lat) || isNaN(lng)) {
            return null;
        }

        return { lat, lng };
    }

    // ============================================
    // INIT MAP
    // ============================================
    function initVrMap() {
        if (vrMap) return vrMap;

        const mapEl = document.getElementById('vr_waypoint_map');
        if (!mapEl) {
            console.warn('[VR Map] Element #vr_waypoint_map tidak ditemukan');
            return null;
        }

        vrMap = L.map('vr_waypoint_map', {
            center: DEFAULT_CENTER,
            zoom: DEFAULT_ZOOM,
            zoomControl: true,
            attributionControl: false,
            scrollWheelZoom: false,
        });

        // OpenStreetMap tile
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            minZoom: 3,
        }).addTo(vrMap);

        // Attribution
        L.control.attribution({ position: 'bottomright', prefix: false })
            .addAttribution('&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>')
            .addTo(vrMap);

        // Aktifkan scroll zoom saat hover
        vrMap.on('click', () => vrMap.scrollWheelZoom.enable());
        vrMap.on('mouseout', () => vrMap.scrollWheelZoom.disable());

        setTimeout(() => vrMap.invalidateSize(), 300);

        return vrMap;
    }

    // ============================================
    // CREATE MARKER ICON
    // ============================================
    function createWaypointIcon(type, number) {
        let bgColor, content;

        if (type === 'start') {
            bgColor = 'linear-gradient(135deg, #0d6efd, #0a58ca)';
            content = '<i class="fas fa-play" style="color:#fff;font-size:0.5rem;"></i>';
        } else if (type === 'end') {
            bgColor = 'linear-gradient(135deg, #dc3545, #b02a37)';
            content = '<i class="fas fa-flag-checkered" style="color:#fff;font-size:0.55rem;"></i>';
        } else {
            bgColor = 'linear-gradient(135deg, #6c757d, #495057)';
            content = `<span class="wp-num">${number}</span>`;
        }

        return L.divIcon({
            className: 'vr-map-marker ' + type,
            html: `<div class="pin" style="background:${bgColor}">${content}</div>`,
            iconSize: type === 'mid' ? [18, 18] : [22, 22],
            iconAnchor: type === 'mid' ? [9, 18] : [11, 22],
            popupAnchor: [0, -20],
        });
    }

    // ============================================
    // DRAW ROUTE DARI ARRAY WAYPOINT
    // ============================================
    function drawWaypointRoute(waypoints, meta) {
        const map = initVrMap();
        if (!map) return;

        if (!Array.isArray(waypoints) || waypoints.length === 0) {
            showVrEmpty('Data waypoint kosong');
            return;
        }

        // Parse semua koordinat
        const parsed = waypoints
            .map((wp, idx) => {
                const coords = parseWaypointCoords(wp);
                return coords ? { ...wp, ...coords, _idx: idx } : null;
            })
            .filter(Boolean);

        if (parsed.length === 0) {
            showVrEmpty('Koordinat waypoint tidak valid');
            return;
        }

        // Sort by sequence
        parsed.sort((a, b) => {
            const seqA = parseInt(a.sequence) || 0;
            const seqB = parseInt(b.sequence) || 0;
            return seqA - seqB;
        });

        // Clear layer lama
        clearVrRoute();

        // ===== Build latlngs array =====
        const latlngs = parsed.map(p => [p.lat, p.lng]);

        // ===== Glow layer (bawah) =====
        vrGlowLayer = L.polyline(latlngs, {
            color: '#00c9a7',
            weight: 10,
            opacity: 0.2,
            lineCap: 'round',
            lineJoin: 'round',
        }).addTo(map);

        // ===== Main route line =====
        vrRouteLayer = L.polyline(latlngs, {
            color: '#2c0074',
            weight: 3.5,
            opacity: 0.9,
            lineCap: 'round',
            lineJoin: 'round',
        }).addTo(map);

        // ===== Markers untuk setiap waypoint =====
        parsed.forEach((wp, idx) => {
            let type = 'mid';
            if (idx === 0) type = 'start';
            else if (idx === parsed.length - 1) type = 'end';

            const marker = L.marker([wp.lat, wp.lng], {
                icon: createWaypointIcon(type, idx + 1),
                title: wp.nama || 'Waypoint ' + (idx + 1),
            }).addTo(map);

            // Popup content
            const distance = wp.jarak_antar_titik ? parseFloat(wp.jarak_antar_titik).toFixed(2) + ' NM' : '-';
            const total = wp.total_jarak ? parseFloat(wp.total_jarak).toFixed(2) + ' NM' : '-';
            const haluan = wp.haluan || '-';

            marker.bindPopup(`
                <div style="min-width: 200px;">
                    <div style="font-weight:700; color:#2c0074; font-size:0.85rem; margin-bottom:0.4rem; display:flex; align-items:center; gap:0.4rem;">
                        <span style="display:inline-block; width:20px; height:20px; border-radius:50%; background:#2c0074; color:#fff; text-align:center; line-height:20px; font-size:0.7rem;">${idx + 1}</span>
                        ${wp.nama || 'Waypoint ' + (idx + 1)}
                    </div>
                    <div style="font-size:0.75rem; color:#5a5c69; line-height:1.6;">
                        <div><strong>Sequence:</strong> ${wp.sequence || '-'}</div>
                        <div><strong>Posisi:</strong> ${wp.lintang || '-'} , ${wp.bujur || '-'}</div>
                        <div><strong>Haluan:</strong> ${haluan}°</div>
                        <div><strong>Jarak:</strong> ${distance}</div>
                        <div><strong>Total:</strong> ${total}</div>
                    </div>
                </div>
            `);

            vrMarkers.push(marker);
        });

        // ===== Fit bounds =====
        const bounds = L.latLngBounds(latlngs);
        map.fitBounds(bounds, {
            padding: [40, 40],
            maxZoom: 9,
            animate: true,
            duration: 0.8,
        });

        // ===== Update summary =====
        const first = parsed[0];
        const last = parsed[parsed.length - 1];
        const totalDistance = parseFloat(last.total_jarak || 0).toFixed(2);

        document.getElementById('vr_start_label').textContent = first.nama || 'Start';
        document.getElementById('vr_end_label').textContent = last.nama || 'End';
        document.getElementById('vr_waypoint_count').textContent = parsed.length;
        document.getElementById('vr_total_distance').textContent = totalDistance + ' NM';
        document.getElementById('vr_route_summary').style.display = 'flex';
        document.getElementById('vr_map_empty').style.display = 'none';

        // Update status
        const statusEl = document.getElementById('vr_map_status');
        statusEl.className = 'map-status loaded';
        statusEl.innerHTML = `<i class="fas fa-check-circle"></i> Rute dimuat (${parsed.length} waypoint)`;

        // Simpan data untuk referensi
        window.__vrLastData = parsed;
    }

    // ============================================
    // CLEAR ROUTE
    // ============================================
    function clearVrRoute() {
        const map = vrMap;
        if (!map) return;

        if (vrGlowLayer) { map.removeLayer(vrGlowLayer); vrGlowLayer = null; }
        if (vrRouteLayer) { map.removeLayer(vrRouteLayer); vrRouteLayer = null; }

        vrMarkers.forEach(m => {
            if (map.hasLayer(m)) map.removeLayer(m);
        });
        vrMarkers = [];
    }

    // ============================================
    // SHOW EMPTY STATE
    // ============================================
    function showVrEmpty(message) {
        clearVrRoute();

        const emptyEl = document.getElementById('vr_map_empty');
        if (emptyEl) {
            emptyEl.style.display = 'flex';
            const p = emptyEl.querySelector('p');
            if (p && message) p.textContent = message;
        }

        document.getElementById('vr_route_summary').style.display = 'none';

        const statusEl = document.getElementById('vr_map_status');
        statusEl.className = 'map-status';
        statusEl.innerHTML = '<i class="fas fa-info-circle"></i> Pilih data dari List Data untuk melihat rute';

        if (vrMap) {
            vrMap.setView(DEFAULT_CENTER, DEFAULT_ZOOM, { animate: true });
        }
    }

    // ============================================
    // LOAD FROM URL PARAMETER
    // ============================================
    function loadFromUrlParam() {
        // Ambil parameter detail_waypoint dari URL
        let detailWaypoint = null;

        try {
            // Coba dengan $ummu.url.getParam
            if (window.$ummu && window.$ummu.url && typeof window.$ummu.url.getParam === 'function') {
                detailWaypoint = $ummu.url.getParam('detail_waypoint');
            }
        } catch (e) {
            console.warn('[VR Map] $ummu.url.getParam gagal, fallback ke URLSearchParams');
        }

        // Fallback: manual parse dari URL
        if (!detailWaypoint) {
            try {
                const urlParams = new URLSearchParams(window.location.search);
                detailWaypoint = urlParams.get('detail_waypoint');
            } catch (e) {
                console.warn('[VR Map] URLSearchParams gagal:', e);
            }
        }

        if (!detailWaypoint) {
            console.log('[VR Map] Tidak ada parameter detail_waypoint di URL');
            return false;
        }

        console.log('[VR Map] Menemukan detail_waypoint:', detailWaypoint);

        let waypointsData = null;

        // Coba parse sebagai JSON string
        try {
            // Coba decode dulu (jika di-encode URL)
            let decoded = detailWaypoint;
            try {
                decoded = decodeURIComponent(detailWaypoint);
            } catch (e) { /* ignore */ }

            // Coba parse JSON
            waypointsData = JSON.parse(decoded);
        } catch (e) {
            console.warn('[VR Map] Gagal parse JSON, mencoba fetch sebagai URL/endpoint:', e);
        }

        // Jika bukan JSON, mungkin berupa URL endpoint — fetch
        if (!waypointsData && typeof detailWaypoint === 'string' && detailWaypoint.startsWith('http')) {
            fetchWaypointFromUrl(detailWaypoint);
            return true;
        }

        if (Array.isArray(waypointsData)) {
            drawWaypointRoute(waypointsData);
            vrIsLoadedFromUrl = true;
            return true;
        }

        return false;
    }

    // ============================================
    // FETCH DARI URL ENDPOINT
    // ============================================
    async function fetchWaypointFromUrl(url) {
        const statusEl = document.getElementById('vr_map_status');
        statusEl.className = 'map-status';
        statusEl.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memuat data waypoint...';

        try {
            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': (window.settings && window.settings.token) ? window.settings.token : '',
                },
            });
            const data = await res.json();

            let rows = null;
            if (Array.isArray(data)) rows = data;
            else if (data && Array.isArray(data.rows)) rows = data.rows;
            else if (data && Array.isArray(data.data)) rows = data.data;

            if (rows && rows.length > 0) {
                drawWaypointRoute(rows);
                vrIsLoadedFromUrl = true;
            } else {
                showVrEmpty('Data waypoint tidak ditemukan dari URL');
            }
        } catch (e) {
            console.error('[VR Map] Fetch error:', e);
            showVrEmpty('Gagal memuat data waypoint dari URL');
        }
    }

    // ============================================
    // PUBLIC API
    // ============================================
    window.VoyageRouteMap = {
        init: initVrMap,
        clear: showVrEmpty,
        loadFromUrl: loadFromUrlParam,

        /**
         * Set rute dari array waypoint
         * @param {Array} waypoints - array of waypoint objects
         */
        setWaypoints: function (waypoints) {
            drawWaypointRoute(waypoints);
        },

        /**
         * Set rute dari single waypoint object (single point preview)
         */
        setWaypoint: function (wp) {
            if (!wp) return;
            drawWaypointRoute([wp]);
        },

        /**
         * Parse koordinat DM format (expose untuk dipakai eksternal)
         */
        parseCoordinate: parseCoordinate,
    };

    // ============================================
    // AUTO-INIT saat DOM ready
    // ============================================
    document.addEventListener('DOMContentLoaded', function () {
        // Init map (tapi belum render apa-apa)
        initVrMap();

        // Coba load dari URL parameter
        setTimeout(function () {
            loadFromUrlParam();
        }, 500);

        // Re-init saat tab form ditampilkan
        const formTab = document.getElementById('nav-tab-form');
        if (formTab) {
            formTab.addEventListener('shown.bs.tab', function () {
                setTimeout(() => {
                    if (vrMap) vrMap.invalidateSize();
                }, 200);
            });
        }
    });

    // Handle jika tab di-toggle
    document.addEventListener('click', function (e) {
        if (e.target.closest('#nav-tab-form') || e.target.closest('#nav-tab-listData')) {
            setTimeout(() => {
                if (vrMap) vrMap.invalidateSize();
            }, 300);
        }
    });
})();

// ============================================
// HOOK DATATABLE CLICK → LOAD WAYPOINT KE MAP
// ============================================
(function () {
    'use strict';

    // Fungsi untuk handle ketika baris di v_dataTable diklik
    function handleRowClick(rowData) {
        if (!rowData) return;

        // Cari URL detail waypoint di berbagai field yang mungkin
        const possibleUrlFields = [
            'detail_waypoint', 'detail_waypoint_url', 'url_waypoint',
            'waypoint_url', 'detail_url', 'url'
        ];

        let detailUrl = null;
        for (const field of possibleUrlFields) {
            if (rowData[field] && typeof rowData[field] === 'string') {
                detailUrl = rowData[field];
                break;
            }
        }

        // Kalau tidak ada field URL, coba cek di data attribute row
        if (!detailUrl) {
            // Cari di DOM
            const $clickedRow = $('#v_dataTable tbody tr.selected, #v_dataTable tbody tr.active');
            if ($clickedRow.length) {
                detailUrl = $clickedRow.data('detail-waypoint')
                    || $clickedRow.attr('data-detail-waypoint')
                    || $clickedRow.find('[data-detail-waypoint]').data('detail-waypoint');
            }
        }

        if (detailUrl) {
            console.log('[VR Map] Loading dari URL:', detailUrl);
            if (window.VoyageRouteMap && typeof window.VoyageRouteMap.setWaypoints === 'function') {
                fetchAndDraw(detailUrl);
            }
        } else if (rowData.waypoints && Array.isArray(rowData.waypoints)) {
            // Jika data waypoint langsung ada di rowData
            console.log('[VR Map] Loading dari rowData.waypoints');
            window.VoyageRouteMap.setWaypoints(rowData.waypoints);
        } else if (Array.isArray(rowData) && rowData.length > 0 && rowData[0].lintang) {
            // Kalau rowData sendiri adalah array waypoint
            window.VoyageRouteMap.setWaypoints(rowData);
        }
    }

    // Fetch dari URL dan draw
    async function fetchAndDraw(url) {
        const statusEl = document.getElementById('vr_map_status');
        if (statusEl) {
            statusEl.className = 'map-status';
            statusEl.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memuat rute...';
        }

        try {
            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': (window.settings && window.settings.token) ? window.settings.token : '',
                },
            });
            const data = await res.json();

            let rows = null;
            if (Array.isArray(data)) rows = data;
            else if (data && Array.isArray(data.rows)) rows = data.rows;
            else if (data && Array.isArray(data.data)) rows = data.data;

            if (rows && rows.length > 0) {
                window.VoyageRouteMap.setWaypoints(rows);
            } else {
                if (statusEl) {
                    statusEl.className = 'map-status error';
                    statusEl.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Data waypoint kosong';
                }
            }
        } catch (e) {
            console.error('[VR Map] Fetch error:', e);
            if (statusEl) {
                statusEl.className = 'map-status error';
                statusEl.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Gagal memuat rute';
            }
        }
    }

    // ============================================
    // AUTO-HOOK DATATABLE setelah DOM ready
    // ============================================
    document.addEventListener('DOMContentLoaded', function () {
        // Polling untuk cek apakah DataTable sudah di-init
        const checkInterval = setInterval(function () {
            if ($.fn.DataTable && $.fn.DataTable.isDataTable('#v_dataTable')) {
                clearInterval(checkInterval);

                const dt = $('#v_dataTable').DataTable();

                // Hook event select (DataTables Select extension)
                $('#v_dataTable tbody').on('click', 'tr', function () {
                    const rowData = dt.row(this).data();
                    handleRowClick(rowData);

                    // Coba juga cek dari API detail_waypoint via URL
                    // (jika rowData punya field ID/rute_id)
                    if (rowData && (rowData.id || rowData.rute_id)) {
                        const baseUrl = (window.$ummu && $ummu.vars && $ummu.vars.base_url) ? $ummu.vars.base_url : '';
                        const ruteId = rowData.rute_id || rowData.id;

                        // Coba beberapa endpoint yang mungkin
                        const possibleEndpoints = [
                            baseUrl + 'admin/voyage_route/detail_waypoint/' + ruteId,
                            baseUrl + 'admin/voyage_route/waypoint/' + ruteId,
                            baseUrl + 'voyage_route/detail_waypoint/' + ruteId,
                        ];

                        // Coba endpoint pertama yang umum
                        // (bisa disesuaikan dengan endpoint sebenarnya)
                        // fetchAndDraw(possibleEndpoints[0]);
                    }
                });
            }
        }, 500);

        // Timeout setelah 10 detik, stop polling
        setTimeout(() => clearInterval(checkInterval), 10000);
    });
})();
</script>