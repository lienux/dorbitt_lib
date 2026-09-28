<!-- Leaflet Map CSS -->
<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" /> -->

<style>
    /* ============================================
       VOYAGE ROUTE MAP PREVIEW
       ============================================ */
    .si-map-wrapper {
        background: #fff;
        border: 1px solid var(--si-border);
        border-radius: var(--si-radius);
        padding: 1rem;
        box-shadow: var(--si-shadow);
        margin-bottom: 1.25rem;
        overflow: hidden;
    }

    .si-map-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f3f9;
    }

    .si-map-header .si-icon {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--si-primary), var(--si-primary-light));
        color: #fff;
        border-radius: 6px;
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .si-map-header h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--si-primary);
    }

    .si-map-header .map-status {
        margin-left: auto;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        background: #f1f3f9;
        color: var(--si-text-muted);
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .si-map-header .map-status.loaded {
        background: #d1f2eb;
        color: #0e8f71;
    }

    /* Map container */
    #si_route_map {
        height: 320px;
        width: 100%;
        border-radius: 8px;
        background: #eef1f7;
        position: relative;
        z-index: 1;
    }

    /* Empty state */
    .si-map-empty {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--si-text-muted);
        background: linear-gradient(135deg, #f8f9fc 0%, #eef1f7 100%);
        border-radius: 8px;
        z-index: 2;
        text-align: center;
        padding: 1rem;
    }

    .si-map-empty i {
        font-size: 2rem;
        color: var(--si-primary);
        opacity: 0.4;
        margin-bottom: 0.5rem;
    }

    .si-map-empty p {
        margin: 0;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .si-map-empty small {
        font-size: 0.7rem;
        opacity: 0.8;
    }

    /* Route info overlay */
    .si-route-info {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px dashed var(--si-border);
    }

    .si-route-info .info-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.35rem 0.7rem;
        background: #f8f9fc;
        border-radius: 20px;
        font-size: 0.72rem;
        color: #5a5c69;
    }

    .si-route-info .info-chip i {
        color: var(--si-primary);
        font-size: 0.7rem;
    }

    .si-route-info .info-chip strong {
        color: var(--si-primary);
        margin-left: 0.15rem;
    }

    .si-route-info .info-chip.from {
        background: #e8f4fd;
        border: 1px solid #cfe7f5;
    }

    .si-route-info .info-chip.from i {
        color: #0d6efd;
    }

    .si-route-info .info-chip.to {
        background: #fdeaea;
        border: 1px solid #f5cfcf;
    }

    .si-route-info .info-chip.to i {
        color: #dc3545;
    }

    .si-route-info .info-chip.distance {
        background: #f3e8fd;
        border: 1px solid #e0cff5;
    }

    .si-route-info .info-chip.distance i {
        color: #6f42c1;
    }

    /* Custom marker icons */
    .si-map-marker {
        background: transparent;
        border: none;
    }

    .si-map-marker .pin {
        width: 24px;
        height: 24px;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .si-map-marker .pin i {
        transform: rotate(45deg);
        color: #fff;
        font-size: 0.65rem;
    }

    .si-map-marker.start .pin {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
    }

    .si-map-marker.end .pin {
        background: linear-gradient(135deg, #dc3545, #b02a37);
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

    /* Responsive */
    @media (max-width: 767.98px) {
        #si_route_map {
            height: 240px;
        }

        .si-route-info .info-chip {
            font-size: 0.68rem;
            padding: 0.3rem 0.55rem;
        }
    }
</style>

<!-- Form -->
<div id="form_input"> 
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Date<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-datepicker" id="iDate" data-label="Tanggal SI" placeholder="Pilih tanggal SI" readonly disabled required>
                        <span class="popup-text">ex: Tanggal SI</span>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="iDate" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Number<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <input type="text" name="number" id="number" class="form-control form-control-sm endis" placeholder="Masukan Nomor SI" data-label="Number" required disabled required>
                    <span class="popup-text">ex: Nomor SI</span>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Shipper<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="client" placeholder="Pilih Shipper / Client" data-label="Shipper" disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_client" type="button" disabled
                                data-inputid="client" data-modaltitle="Master Data Clients">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Tugboat<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="tugboat" placeholder="Pilih Tugboat" data-label="Tugboat" required disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_tugboat" type="button" disabled
                                data-inputid="tugboat" data-modaltitle="Master Data Vessel - Tugboat">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Barge<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="barge" placeholder="Pilih Barge" data-label="Barge" disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_barge" type="button" disabled
                                data-inputid="barge" data-modaltitle="Master Data Vessel - Barge">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Load Type<span class="text-danger small"> *</span></label>
                <div class="col-sm-9">
                    <input type="text" name="load_type" id="load_type" class="form-control form-control-sm endis" placeholder="Enter Load Type" data-label="Load Type" required disabled>
                    <span class="popup-text">ex: Batubara / Pasir / etc.</span>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label mb-0 pb-0">Quantity<span class="text-danger small"> *</span></label>
                <div class="col-sm-3 mb-2">
                    <input type="text" name="qty" id="qty" class="form-control form-control-sm endis" placeholder="Masukan Jumlah Muatan" data-label="Quantity" required disabled>
                </div>

                <label class="col-sm-3 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                    UoM<span class="text-danger small"> *</span>
                </label>
                <div class="col-sm-3 mb-2">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="uom" placeholder="Pilih Satuan" data-label="UoM" disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_uom" type="button" disabled
                                data-inputid="uom" data-modaltitle="Master Data - Unit of Measure">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <!-- <input type="text" id="rangePicker" placeholder="Pilih rentang tanggal.."> -->

            <!-- <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Date of Loading From<span class="text-danger small"> *</span></label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-datepicker" id="iDateLoadingFrom" placeholder="Pilih Batas Awal Tanggal Muat" data-label="Date of Loading From" readonly disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="iDateLoadingFrom" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Date of Loading To</label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-datepicker" id="iDateLoadingTo" placeholder="Pilih Batas Akhir Muat" data-label="Date of Loading To" required readonly disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="iDateLoadingTo" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Date of Loading<span class="text-danger small"> *</span></label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-datepicker" id="iDateLoadingFrom" placeholder="Pilih Tanggal Muat" data-label="Date of Loading From" readonly disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="iDateLoadingFrom" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control ummu-datepicker" id="iDateLoadingTo" placeholder="Sampai tanggal." data-label="Date of Loading To" required readonly disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="iDateLoadingTo" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ummu-datepicker" id="iDateLoadingTo" placeholder="Pilih Batas Akhir Muat" data-label="Date of Loading To" required readonly disabled>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-show-datepicker endis btn-endis" type="button"
                                data-inputid="iDateLoadingTo" disabled>
                                <i class="fas fa-calendar-alt"></i>
                            </button>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Port of Loading<span class="text-danger small"> *</span></label>
                <div class="col-sm-8">
                    <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm endis" placeholder="Masukan Nama Pelabuhan Muat" data-label="Port of Loading" required disabled>
                    <span class="popup-text">ex: Jetty Borneo Mandiri Prima Energi, Batang Kulur, KalSel</span>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">Port of Discharge<span class="text-danger small"> *</span></label>
                <div class="col-sm-8">
                    <input type="text" name="discharge_port" id="discharge_port" class="form-control form-control-sm endis" placeholder="Masukan Nama Pelabuhan Bongkar" data-label= "Port of Discharge" required disabled>
                    <span class="popup-text">ex: Jettu Pelindo, Bojonegara, Jawa Barat</span>
                </div>
            </div> -->
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                    Voyage Route<span class="text-danger small"> *</span>
                </label>
                <div class="col-sm-8">
                    <!-- <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm endis" placeholder="Pilih list voyage route" data-label="Port of Loading" required disabled>
                    <span class="popup-text">ex: Jetty Borneo Mandiri Prima Energi, Batang Kulur, KalSel</span> -->
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="voyage_route" placeholder="Pilih voyage route" data-label="Voyage Route" disabled required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary endis show-left-modal btn-endis" id="btn_show_voyage_route" type="button" disabled
                                data-inputid="voyage_route" data-modaltitle="Master Data Voyage Route">
                                <i class="fas fa-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                    Port of Loading
                </label>
                <div class="col-sm-8">
                    <input type="text" name="loading_port" id="loading_port" class="form-control form-control-sm" placeholder="Auto setelah pilih Voyage Route..." disabled>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">
                    Port of Discharge
                </label>
                <div class="col-sm-8">
                    <input type="text" name="discharge_port" id="discharge_port" class="form-control form-control-sm" placeholder="Auto setelah pilih Voyage Route..." disabled>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label mb-0 pb-0 text-lg-right text-sm-left">File<span class="text-danger small"> *</span></label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm">
                        <!-- <input type="file" class="form-control endis" id="file_upload" disabled> -->
                        <div class="custom-file custom-file-sm">
                            <input type="file" class="custom-file-input endis" id="file_upload" name="file_upload" data-label="File" disabled>
                            <label class="custom-file-label" for="file_upload">Choose file...</label>
                        </div>
                    </div>
                    <div>
                        <a id="file_url" target="_blank">
                            <span>Click here to open File.</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     VOYAGE ROUTE MAP PREVIEW
     ============================================ -->
<div class="si-map-wrapper">
    <div class="si-map-header">
        <span class="si-icon"><i class="fas fa-map-marked-alt"></i></span>
        <h6>Pratinjau Rute Voyage</h6>
        <span class="map-status" id="map_status">
            <i class="fas fa-circle-notch fa-spin"></i> Menunggu pilihan
        </span>
    </div>

    <div style="position: relative;">
        <div id="si_route_map"></div>
        <div class="si-map-empty" id="si_map_empty">
            <i class="fas fa-route"></i>
            <p>Rute belum dipilih</p>
            <small>Pilih <strong>Voyage Route</strong> untuk melihat rute pada peta</small>
        </div>
    </div>

    <div class="si-route-info" id="si_route_info" style="display:none;">
        <span class="info-chip from">
            <i class="fas fa-map-pin"></i>
            <span>From:</span> <strong id="route_from_label">-</strong>
        </span>
        <span class="info-chip to">
            <i class="fas fa-flag-checkered"></i>
            <span>To:</span> <strong id="route_to_label">-</strong>
        </span>
        <span class="info-chip distance">
            <i class="fas fa-ruler-horizontal"></i>
            <span>Jarak:</span> <strong id="route_distance_label">-</strong>
        </span>
        <span class="info-chip">
            <i class="fas fa-ship"></i>
            <span>Estimasi:</span> <strong id="route_eta_label">-</strong>
        </span>
    </div>
</div>

<script>
// ============================================
// VOYAGE ROUTE MAP - Shipping Instruction
// ============================================
(function () {
    let siMap = null;
    let siRouteLayer = null;
    let siMarkerStart = null;
    let siMarkerEnd = null;

    // Default center: Indonesia (Selat Makassar area)
    const DEFAULT_CENTER = [-2.5, 118.0];
    const DEFAULT_ZOOM = 5;

    // ============================================
    // INIT MAP
    // ============================================
    function initSiMap() {
        if (siMap) return siMap;

        const mapEl = document.getElementById('si_route_map');
        if (!mapEl) return null;

        // Initialize map
        siMap = L.map('si_route_map', {
            center: DEFAULT_CENTER,
            zoom: DEFAULT_ZOOM,
            zoomControl: true,
            attributionControl: false,
            scrollWheelZoom: false,
        });

        // Tile layer: OpenStreetMap (gratis, tanpa API key)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            minZoom: 3,
        }).addTo(siMap);

        // Attribution kecil di kanan bawah
        L.control.attribution({ position: 'bottomright', prefix: false })
            .addAttribution('&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>')
            .addTo(siMap);

        // Aktifkan scroll zoom saat user klik peta
        siMap.on('click', function () {
            siMap.scrollWheelZoom.enable();
        });
        siMap.on('mouseout', function () {
            siMap.scrollWheelZoom.disable();
        });

        // Pastikan peta render sempurna setelah tab/form tampil
        setTimeout(() => siMap.invalidateSize(), 300);

        return siMap;
    }

    // ============================================
    // CUSTOM MARKER ICON
    // ============================================
    function createPinIcon(type) {
        const iconColor = type === 'start' ? 'start' : 'end';
        const iconSymbol = type === 'start' ? 'fa-ship' : 'fa-flag-checkered';

        return L.divIcon({
            className: 'si-map-marker ' + iconColor,
            html: `<div class="pin"><i class="fas ${iconSymbol}"></i></div>`,
            iconSize: [24, 24],
            iconAnchor: [12, 24],
            popupAnchor: [0, -24],
        });
    }

    // ============================================
    // HITUNG JARAK (Haversine)
    // ============================================
    function haversineDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius bumi dalam km
        const toRad = (deg) => (deg * Math.PI) / 180;

        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);

        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c; // km
    }

    // ============================================
    // FORMAT JARAK
    // ============================================
    function formatDistance(km) {
        if (km < 1) return (km * 1000).toFixed(0) + ' m';
        if (km < 100) return km.toFixed(1) + ' km';
        return km.toFixed(0) + ' km';
    }

    // ============================================
    // FORMAT ETA (asumsi kecepatan 10 knot ≈ 18.5 km/jam)
    // ============================================
    function formatETA(km) {
        const speedKnot = 10;
        const speedKmh = speedKnot * 1.852;
        const hours = km / speedKmh;

        if (hours < 24) {
            return hours.toFixed(1) + ' jam';
        }
        const days = hours / 24;
        return days.toFixed(1) + ' hari';
    }

    // ============================================
    // DRAW ROUTE
    // ============================================
    function drawRoute(routeData) {
        const map = initSiMap();
        if (!map) return;

        const { from, to, fromLabel, toLabel } = routeData;

        if (!from || !to || !from.lat || !from.lng || !to.lat || !to.lng) {
            clearRoute();
            return;
        }

        // Hapus layer sebelumnya
        clearRoute();

        const startLatLng = [from.lat, from.lng];
        const endLatLng = [to.lat, to.lng];

        // ===== Marker Start =====
        siMarkerStart = L.marker(startLatLng, {
            icon: createPinIcon('start'),
            title: 'Port of Loading',
        }).addTo(map);

        siMarkerStart.bindPopup(`
            <div style="font-family: inherit; min-width: 180px;">
                <div style="font-weight:700; color:#0d6efd; font-size:0.85rem; margin-bottom:4px;">
                    <i class="fas fa-ship"></i> Port of Loading
                </div>
                <div style="font-size:0.8rem; color:#333;">${fromLabel || '-'}</div>
            </div>
        `);

        // ===== Marker End =====
        siMarkerEnd = L.marker(endLatLng, {
            icon: createPinIcon('end'),
            title: 'Port of Discharge',
        }).addTo(map);

        siMarkerEnd.bindPopup(`
            <div style="font-family: inherit; min-width: 180px;">
                <div style="font-weight:700; color:#dc3545; font-size:0.85rem; margin-bottom:4px;">
                    <i class="fas fa-flag-checkered"></i> Port of Discharge
                </div>
                <div style="font-size:0.8rem; color:#333;">${toLabel || '-'}</div>
            </div>
        `);

        // ===== Garis Rute (Polyline) =====
        siRouteLayer = L.polyline([startLatLng, endLatLng], {
            color: '#2c0074',
            weight: 3,
            opacity: 0.85,
            dashArray: '12, 10',
            lineCap: 'round',
            lineJoin: 'round',
        }).addTo(map);

        // Garis glow di bawah (untuk efek visual)
        const glowLayer = L.polyline([startLatLng, endLatLng], {
            color: '#00c9a7',
            weight: 8,
            opacity: 0.15,
        }).addTo(map);

        // Simpan referensi agar bisa dihapus
        siRouteLayer._glowLayer = glowLayer;

        // ===== Zoom ke bounds =====
        const bounds = L.latLngBounds([startLatLng, endLatLng]);
        map.fitBounds(bounds, {
            padding: [50, 50],
            maxZoom: 8,
            animate: true,
            duration: 0.8,
        });

        // ===== Hitung jarak & ETA =====
        const distanceKm = haversineDistance(from.lat, from.lng, to.lat, to.lng);

        // Update UI info
        document.getElementById('route_from_label').textContent = fromLabel || '-';
        document.getElementById('route_to_label').textContent = toLabel || '-';
        document.getElementById('route_distance_label').textContent = formatDistance(distanceKm) + ' (garis lurus)';
        document.getElementById('route_eta_label').textContent = '~' + formatETA(distanceKm) + ' @10 knot';

        document.getElementById('si_route_info').style.display = 'flex';
        document.getElementById('si_map_empty').style.display = 'none';

        // Update status
        const statusEl = document.getElementById('map_status');
        statusEl.className = 'map-status loaded';
        statusEl.innerHTML = '<i class="fas fa-check-circle"></i> Rute ditampilkan';
    }

    // ============================================
    // CLEAR ROUTE
    // ============================================
    function clearRoute() {
        const map = siMap;
        if (!map) return;

        if (siMarkerStart) { map.removeLayer(siMarkerStart); siMarkerStart = null; }
        if (siMarkerEnd) { map.removeLayer(siMarkerEnd); siMarkerEnd = null; }

        if (siRouteLayer) {
            if (siRouteLayer._glowLayer) map.removeLayer(siRouteLayer._glowLayer);
            map.removeLayer(siRouteLayer);
            siRouteLayer = null;
        }

        document.getElementById('si_route_info').style.display = 'none';
        document.getElementById('si_map_empty').style.display = 'flex';

        const statusEl = document.getElementById('map_status');
        statusEl.className = 'map-status';
        statusEl.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Menunggu pilihan';

        if (map) {
            map.setView(DEFAULT_CENTER, DEFAULT_ZOOM, { animate: true });
        }
    }

    // ============================================
    // GEOCODING FALLBACK (jika koordinat tidak tersedia)
    // Menggunakan Nominatim OpenStreetMap (gratis)
    // ============================================
    async function geocodePort(portName) {
        if (!portName) return null;

        try {
            const url = `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(portName)}`;
            const res = await fetch(url, {
                headers: { 'Accept-Language': 'id,en' }
            });
            const data = await res.json();

            if (data && data.length > 0) {
                return {
                    lat: parseFloat(data[0].lat),
                    lng: parseFloat(data[0].lon),
                };
            }
        } catch (e) {
            console.warn('[SI Map] Geocoding error untuk:', portName, e);
        }
        return null;
    }

    // ============================================
    // PUBLIC API
    // ============================================
    window.SiRouteMap = {
        init: initSiMap,
        clear: clearRoute,
        geocode: geocodePort,

        /**
         * Set rute dari data voyage
         * @param {Object} data
         * @param {Object} data.from - { lat, lng, label } koordinat port of loading
         * @param {Object} data.to   - { lat, lng, label } koordinat port of discharge
         * @param {String} [data.fromLabel] - label port of loading (fallback)
         * @param {String} [data.toLabel]   - label port of discharge (fallback)
         */
        setRoute: function (data) {
            drawRoute({
                from: data.from,
                to: data.to,
                fromLabel: data.fromLabel || (data.from && data.from.label) || '',
                toLabel: data.toLabel || (data.to && data.to.label) || '',
            });
        },

        /**
         * Set rute berdasarkan nama port (auto-geocode)
         * @param {String} fromName - nama port of loading
         * @param {String} toName   - nama port of discharge
         */
        setRouteByNames: async function (fromName, toName) {
            const map = initSiMap();
            if (!map) return;

            // Update status: loading
            const statusEl = document.getElementById('map_status');
            statusEl.className = 'map-status';
            statusEl.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memuat koordinat...';

            const [fromCoord, toCoord] = await Promise.all([
                geocodePort(fromName),
                geocodePort(toName),
            ]);

            if (!fromCoord || !toCoord) {
                statusEl.className = 'map-status';
                statusEl.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Koordinat tidak ditemukan';
                return;
            }

            drawRoute({
                from: { ...fromCoord, label: fromName },
                to: { ...toCoord, label: toName },
                fromLabel: fromName,
                toLabel: toName,
            });
        },
    };

    // ============================================
    // AUTO-INIT saat DOM ready
    // ============================================
    document.addEventListener('DOMContentLoaded', function () {
        initSiMap();

        // Re-init saat tab form ditampilkan (karena mungkin awalnya hidden)
        const formTab = document.getElementById('nav-tab-form');
        if (formTab) {
            formTab.addEventListener('shown.bs.tab', function () {
                setTimeout(() => {
                    if (siMap) siMap.invalidateSize();
                }, 200);
            });
        }
    });

    // Handle jika tab di-toggle
    document.addEventListener('click', function (e) {
        if (e.target.closest('#nav-tab-form')) {
            setTimeout(() => {
                if (siMap) siMap.invalidateSize();
            }, 300);
        }
    });
})();
</script>