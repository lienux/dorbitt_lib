<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Rute & Waypoint dengan Peta Fullscreen</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body {
            background-color: #f4f6f9;
            padding: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        #map {
            height: 450px;
            border-radius: 8px;
            border: 2px solid #007bff;
            z-index: 1;
            transition: all 0.3s ease;
        }
        .waypoint-item {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: all 0.2s;
        }
        .waypoint-item:hover {
            background: #e9ecef;
            transform: translateX(3px);
        }
        .waypoint-number {
            display: inline-block;
            background: #007bff;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            text-align: center;
            line-height: 28px;
            font-weight: bold;
            margin-right: 8px;
        }
        .btn-action {
            margin-left: 5px;
        }
        .badge-info {
            font-size: 12px;
        }
        .map-hint {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 13px;
            margin-bottom: 10px;
        }
        .empty-waypoint {
            text-align: center;
            color: #6c757d;
            padding: 20px;
            font-style: italic;
        }
        #jsonPreview {
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 15px;
            border-radius: 5px;
            font-size: 12px;
            max-height: 400px;
            overflow: auto;
            font-family: 'Courier New', monospace;
        }

        /* ==================== FULLSCREEN MAP STYLES ==================== */
        #map:fullscreen {
            height: 100vh !important;
            width: 100vw !important;
            border-radius: 0;
            border: none;
        }
        #map:-webkit-full-screen {
            height: 100vh !important;
            width: 100vw !important;
            border-radius: 0;
            border: none;
        }
        #map:-moz-full-screen {
            height: 100vh !important;
            width: 100vw !important;
            border-radius: 0;
            border: none;
        }
        #map:-ms-fullscreen {
            height: 100vh !important;
            width: 100vw !important;
            border-radius: 0;
            border: none;
        }

        .map-toolbar {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            display: flex;
            gap: 5px;
        }
        .map-toolbar .btn {
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
            font-weight: 500;
        }

        .fs-toolbar {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            background: rgba(255, 255, 255, 0.95);
            padding: 8px 15px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.25);
            display: none;
            align-items: center;
            gap: 10px;
        }
        .fs-toolbar.active {
            display: flex;
        }
        .fs-toolbar .fs-info {
            font-size: 13px;
            color: #333;
            font-weight: 500;
            padding-right: 10px;
            border-right: 1px solid #ddd;
        }
        .fs-toolbar .badge {
            font-size: 12px;
            padding: 5px 10px;
        }

        .fs-waypoint-panel {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            background: rgba(255, 255, 255, 0.98);
            padding: 12px 18px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            display: none;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            max-width: 95vw;
        }
        .fs-waypoint-panel.active {
            display: flex;
        }
        .fs-waypoint-panel input {
            padding: 6px 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 13px;
        }
        .fs-waypoint-panel input[name="fsName"] {
            width: 200px;
        }
        .fs-waypoint-panel input[name="fsLat"],
        .fs-waypoint-panel input[name="fsLng"] {
            width: 110px;
        }

        .map-toast {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            z-index: 10000;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            display: none;
            animation: slideDown 0.3s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translate(-50%, -20px); }
            to { opacity: 1; transform: translate(-50%, 0); }
        }

        #map:fullscreen .leaflet-control-zoom {
            margin-top: 60px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h3><i class="fas fa-route"></i> Form Input Rute & Waypoint</h3>
            <p class="text-muted">Buat rute perjalanan, tambahkan waypoint secara manual atau klik langsung di peta. Gunakan tombol <i class="fas fa-expand text-primary"></i> untuk mode fullscreen.</p>
        </div>
    </div>

    <div class="row">
        <!-- KOLOM KIRI: FORM -->
        <div class="col-lg-5 mb-3">
            <!-- FORM RUTE -->
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Informasi Rute
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="routeName">Nama Rute <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="routeName" placeholder="Contoh: Trip Bali - Lombok">
                    </div>
                    <div class="form-group">
                        <label for="routeDescription">Deskripsi Rute</label>
                        <textarea class="form-control" id="routeDescription" rows="2" placeholder="Deskripsi singkat rute..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="routeDate">Tanggal Rute</label>
                                <input type="date" class="form-control" id="routeDate">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="routeColor">Warna Rute</label>
                                <input type="color" class="form-control" id="routeColor" value="#007bff" style="height: 38px; padding: 2px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORM WAYPOINT -->
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <i class="fas fa-map-pin"></i> Tambah Waypoint
                </div>
                <div class="card-body">
                    <div class="map-hint">
                        <i class="fas fa-mouse-pointer"></i> <strong>Tips:</strong> Klik pada peta untuk mengisi koordinat otomatis. Gunakan <strong>fullscreen</strong> untuk pengalaman terbaik.
                    </div>
                    <div class="form-group">
                        <label for="wpName">Nama Waypoint <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="wpName" placeholder="Contoh: Pelabuhan Padangbai">
                    </div>
                    <div class="form-group">
                        <label for="wpDescription">Deskripsi</label>
                        <input type="text" class="form-control" id="wpDescription" placeholder="Deskripsi singkat...">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wpLat">Latitude</label>
                                <input type="number" step="any" class="form-control" id="wpLat" placeholder="-8.12345">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wpLng">Longitude</label>
                                <input type="number" step="any" class="form-control" id="wpLng" placeholder="115.12345">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-block" id="btnAddWaypoint">
                        <i class="fas fa-plus-circle"></i> Tambah Waypoint
                    </button>
                </div>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <button type="button" class="btn btn-success btn-block mb-2" id="btnSave">
                        <i class="fas fa-save"></i> Simpan ke JSON
                    </button>
                    <button type="button" class="btn btn-secondary btn-block mb-2" id="btnPreview">
                        <i class="fas fa-eye"></i> Preview JSON
                    </button>
                    <button type="button" class="btn btn-danger btn-block" id="btnReset">
                        <i class="fas fa-trash"></i> Reset Semua
                    </button>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: PETA & DAFTAR WAYPOINT -->
        <div class="col-lg-7">
            <!-- PETA -->
            <div class="card shadow-sm mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-map"></i> Peta Interaktif</span>
                    <button type="button" class="btn btn-sm btn-light" id="btnFullscreen" title="Fullscreen (F)">
                        <i class="fas fa-expand"></i> Fullscreen
                    </button>
                </div>
                <div class="card-body p-2" style="position: relative;">
                    <div class="map-toolbar">
                        <button type="button" class="btn btn-sm btn-primary" id="btnFullscreenInline" title="Fullscreen (F)">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                    <div id="map"></div>
                </div>
            </div>

            <!-- DAFTAR WAYPOINT -->
            <div class="card shadow-sm mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-list-ol"></i> Daftar Waypoint</span>
                    <span class="badge badge-light" id="wpCount">0 Waypoint</span>
                </div>
                <div class="card-body" id="waypointList">
                    <div class="empty-waypoint">Belum ada waypoint. Silakan tambah waypoint.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PREVIEW JSON -->
    <div class="modal fade" id="jsonModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-code"></i> Preview JSON</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <pre id="jsonPreview">{}</pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" id="btnDownloadFromModal">
                        <i class="fas fa-download"></i> Download JSON
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== TOOLBAR FULLSCREEN (OVERLAY) ==================== -->
<div class="fs-toolbar" id="fsToolbar">
    <span class="fs-info"><i class="fas fa-expand text-primary"></i> Mode Fullscreen</span>
    <span class="badge badge-primary" id="fsWpCount">0 Waypoint</span>
    <button type="button" class="btn btn-sm btn-success" id="btnFsAddFromForm">
        <i class="fas fa-plus"></i> Tambah dari Form
    </button>
    <button type="button" class="btn btn-sm btn-warning" id="btnFsUndo">
        <i class="fas fa-undo"></i> Undo
    </button>
    <button type="button" class="btn btn-sm btn-danger" id="btnFsExit">
        <i class="fas fa-compress"></i> Keluar
    </button>
</div>

<!-- ==================== PANEL WAYPOINT CEPAT DI FULLSCREEN ==================== -->
<div class="fs-waypoint-panel" id="fsWaypointPanel">
    <i class="fas fa-map-pin text-primary"></i>
    <input type="text" name="fsName" id="fsName" placeholder="Nama waypoint...">
    <input type="number" step="any" name="fsLat" id="fsLat" placeholder="Lat">
    <input type="number" step="any" name="fsLng" id="fsLng" placeholder="Lng">
    <button type="button" class="btn btn-sm btn-primary" id="btnFsAddWaypoint">
        <i class="fas fa-plus"></i> Tambah
    </button>
</div>

<!-- ==================== TOAST NOTIFIKASI ==================== -->
<div class="map-toast" id="mapToast"></div>

<!-- jQuery & Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
$(document).ready(function () {
    // ==================== PERBAIKAN: REFERRER POLICY UNTUK OSM ====================
    // Mencegah "Access blocked" dari tile server OpenStreetMap
    L.TileLayer.prototype.options.referrerPolicy = 'strict-origin-when-cross-origin';

    // ==================== INISIALISASI PETA ====================
    var map = L.map('map').setView([-2.5489, 118.0149], 5); // Center Indonesia

    // Gunakan tile server OpenStreetMap standar (100% gratis, tanpa API key)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19,
        referrerPolicy: 'strict-origin-when-cross-origin'
    }).addTo(map);

    // ==================== VARIABEL GLOBAL ====================
    var waypoints = [];
    var markers = [];
    var routeLine = null;
    var tempMarker = null;
    var isFullscreen = false;

    // ==================== FUNGSI: TOAST NOTIFIKASI ====================
    function showToast(message, type) {
        type = type || 'success';
        var $toast = $('#mapToast');
        $toast.text(message);
        $toast.css('background', type === 'success' ? '#28a745' : (type === 'warning' ? '#ffc107' : '#dc3545'));
        $toast.css('color', type === 'warning' ? '#333' : '#fff');
        $toast.stop(true, true).fadeIn(200).delay(2000).fadeOut(300);
    }

    // ==================== FUNGSI: ICON MARKER BERDASARKAN NOMOR ====================
    function createNumberedIcon(number, color) {
        color = color || '#007bff';
        return L.divIcon({
            className: 'custom-marker',
            html: '<div style="background:' + color + ';color:white;width:30px;height:30px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);display:flex;align-items:center;justify-content:center;border:2px solid white;box-shadow:0 2px 5px rgba(0,0,0,0.3);">' +
                  '<span style="transform:rotate(45deg);font-weight:bold;font-size:13px;">' + number + '</span></div>',
            iconSize: [30, 30],
            iconAnchor: [15, 30],
            popupAnchor: [0, -30]
        });
    }

    // ==================== FUNGSI: RENDER ULANG SEMUA MARKER & RUTE ====================
    function renderMap() {
        markers.forEach(function (m) { map.removeLayer(m); });
        markers = [];

        if (routeLine) {
            map.removeLayer(routeLine);
            routeLine = null;
        }

        var routeColor = $('#routeColor').val() || '#007bff';
        var latlngs = [];

        waypoints.forEach(function (wp, index) {
            var marker = L.marker([wp.lat, wp.lng], {
                icon: createNumberedIcon(index + 1, routeColor),
                draggable: true
            }).addTo(map);

            marker.bindPopup(
                '<strong>' + (index + 1) + '. ' + escapeHtml(wp.name) + '</strong><br>' +
                (wp.description ? escapeHtml(wp.description) + '<br>' : '') +
                '<small>Lat: ' + wp.lat + '<br>Lng: ' + wp.lng + '</small>'
            );

            marker.on('dragend', function (e) {
                var pos = e.target.getLatLng();
                waypoints[index].lat = parseFloat(pos.lat.toFixed(6));
                waypoints[index].lng = parseFloat(pos.lng.toFixed(6));
                renderWaypointList();
                renderMap();
            });

            markers.push(marker);
            latlngs.push([wp.lat, wp.lng]);
        });

        if (latlngs.length >= 2) {
            routeLine = L.polyline(latlngs, {
                color: routeColor,
                weight: 4,
                opacity: 0.8,
                dashArray: '10, 5'
            }).addTo(map);
            map.fitBounds(routeLine.getBounds(), { padding: [40, 40] });
        } else if (latlngs.length === 1) {
            map.setView(latlngs[0], 10);
        }

        $('#fsWpCount').text(waypoints.length + ' Waypoint');
    }

    // ==================== FUNGSI: RENDER DAFTAR WAYPOINT ====================
    function renderWaypointList() {
        var $list = $('#waypointList');
        $list.empty();

        if (waypoints.length === 0) {
            $list.html('<div class="empty-waypoint">Belum ada waypoint. Silakan tambah waypoint.</div>');
            $('#wpCount').text('0 Waypoint');
            $('#fsWpCount').text('0 Waypoint');
            return;
        }

        waypoints.forEach(function (wp, index) {
            var html =
                '<div class="waypoint-item">' +
                    '<div class="d-flex justify-content-between align-items-start">' +
                        '<div class="flex-grow-1">' +
                            '<div><span class="waypoint-number">' + (index + 1) + '</span>' +
                            '<strong>' + escapeHtml(wp.name) + '</strong></div>' +
                            (wp.description ? '<div class="text-muted small ml-4">' + escapeHtml(wp.description) + '</div>' : '') +
                            '<div class="ml-4 mt-1">' +
                                '<span class="badge badge-info badge-info">Lat: ' + wp.lat + '</span> ' +
                                '<span class="badge badge-info badge-info">Lng: ' + wp.lng + '</span>' +
                            '</div>' +
                        '</div>' +
                        '<div>' +
                            '<button class="btn btn-sm btn-outline-primary btn-action" onclick="zoomToWaypoint(' + index + ')" title="Zoom">' +
                                '<i class="fas fa-search-location"></i>' +
                            '</button>' +
                            '<button class="btn btn-sm btn-outline-danger btn-action" onclick="removeWaypoint(' + index + ')" title="Hapus">' +
                                '<i class="fas fa-trash"></i>' +
                            '</button>' +
                        '</div>' +
                    '</div>' +
                '</div>';
            $list.append(html);
        });

        $('#wpCount').text(waypoints.length + ' Waypoint');
        $('#fsWpCount').text(waypoints.length + ' Waypoint');
    }

    // ==================== FUNGSI: ZOOM KE WAYPOINT ====================
    window.zoomToWaypoint = function (index) {
        var wp = waypoints[index];
        if (wp) {
            map.setView([wp.lat, wp.lng], 15);
            markers[index].openPopup();
        }
    };

    // ==================== FUNGSI: HAPUS WAYPOINT ====================
    window.removeWaypoint = function (index) {
        if (confirm('Hapus waypoint ini?')) {
            waypoints.splice(index, 1);
            renderWaypointList();
            renderMap();
        }
    };

    // ==================== FUNGSI: ESCAPE HTML ====================
    function escapeHtml(text) {
        if (!text) return '';
        return $('<div>').text(text).html();
    }

    // ==================== FUNGSI: TAMBAH WAYPOINT (CORE) ====================
    function addWaypointFromData(name, description, lat, lng) {
        waypoints.push({
            name: name,
            description: description || '',
            lat: lat,
            lng: lng
        });
        renderWaypointList();
        renderMap();
    }

    // ==================== EVENT: KLIK PETA UNTUK ISI KOORDINAT ====================
    map.on('click', function (e) {
        var lat = parseFloat(e.latlng.lat.toFixed(6));
        var lng = parseFloat(e.latlng.lng.toFixed(6));

        $('#wpLat').val(lat);
        $('#wpLng').val(lng);
        $('#fsLat').val(lat);
        $('#fsLng').val(lng);

        if (tempMarker) {
            map.removeLayer(tempMarker);
        }

        tempMarker = L.marker([lat, lng], {
            icon: L.divIcon({
                className: 'temp-marker',
                html: '<div style="background:#ffc107;width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,0.4);display:flex;align-items:center;justify-content:center;color:#000;font-weight:bold;">?</div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            })
        }).addTo(map);

        tempMarker.bindPopup('Koordinat dipilih:<br>Lat: ' + lat + '<br>Lng: ' + lng).openPopup();

        if (isFullscreen) {
            $('#fsName').focus();
        } else {
            $('#wpName').focus();
        }
    });

    // ==================== EVENT: TAMBAH WAYPOINT DARI FORM UTAMA ====================
    $('#btnAddWaypoint').on('click', function () {
        var name = $('#wpName').val().trim();
        var description = $('#wpDescription').val().trim();
        var lat = parseFloat($('#wpLat').val());
        var lng = parseFloat($('#wpLng').val());

        if (!name) {
            alert('Nama waypoint harus diisi!');
            $('#wpName').focus();
            return;
        }
        if (isNaN(lat) || isNaN(lng)) {
            alert('Latitude dan Longitude harus diisi! Klik pada peta untuk mengisi otomatis.');
            return;
        }
        if (lat < -90 || lat > 90) {
            alert('Latitude harus antara -90 sampai 90!');
            return;
        }
        if (lng < -180 || lng > 180) {
            alert('Longitude harus antara -180 sampai 180!');
            return;
        }

        addWaypointFromData(name, description, lat, lng);

        if (tempMarker) {
            map.removeLayer(tempMarker);
            tempMarker = null;
        }

        $('#wpName').val('');
        $('#wpDescription').val('');
        $('#wpLat').val('');
        $('#wpLng').val('');
        $('#wpName').focus();
        showToast('Waypoint "' + name + '" berhasil ditambahkan!');
    });

    // ==================== EVENT: TAMBAH WAYPOINT DARI PANEL FULLSCREEN ====================
    $('#btnFsAddWaypoint').on('click', function () {
        var name = $('#fsName').val().trim();
        var lat = parseFloat($('#fsLat').val());
        var lng = parseFloat($('#fsLng').val());

        if (!name) {
            alert('Nama waypoint harus diisi!');
            $('#fsName').focus();
            return;
        }
        if (isNaN(lat) || isNaN(lng)) {
            alert('Klik pada peta terlebih dahulu untuk mengisi koordinat!');
            return;
        }

        addWaypointFromData(name, '', lat, lng);

        if (tempMarker) {
            map.removeLayer(tempMarker);
            tempMarker = null;
        }

        $('#fsName').val('');
        $('#fsLat').val('');
        $('#fsLng').val('');
        $('#fsName').focus();
        showToast('Waypoint "' + name + '" ditambahkan!');
    });

    $('#fsName, #fsLat, #fsLng').on('keypress', function (e) {
        if (e.which === 13) {
            $('#btnFsAddWaypoint').click();
        }
    });

    // ==================== FUNGSI: TOGGLE FULLSCREEN ====================
    function enterFullscreen() {
        var mapEl = document.getElementById('map');

        if (mapEl.requestFullscreen) {
            mapEl.requestFullscreen();
        } else if (mapEl.webkitRequestFullscreen) {
            mapEl.webkitRequestFullscreen();
        } else if (mapEl.mozRequestFullScreen) {
            mapEl.mozRequestFullScreen();
        } else if (mapEl.msRequestFullscreen) {
            mapEl.msRequestFullscreen();
        } else {
            enableCssFullscreen();
        }
    }

    function exitFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else {
            disableCssFullscreen();
        }
    }

    function enableCssFullscreen() {
        $('#map').css({
            position: 'fixed',
            top: 0,
            left: 0,
            width: '100vw',
            height: '100vh',
            zIndex: 9998,
            borderRadius: 0,
            border: 'none'
        });
        isFullscreen = true;
        $('#fsToolbar').addClass('active');
        $('#fsWaypointPanel').addClass('active');
        setTimeout(function () { map.invalidateSize(); }, 100);
    }

    function disableCssFullscreen() {
        $('#map').css({
            position: 'relative',
            top: 'auto',
            left: 'auto',
            width: 'auto',
            height: '450px',
            zIndex: 1,
            borderRadius: '8px',
            border: '2px solid #007bff'
        });
        isFullscreen = false;
        $('#fsToolbar').removeClass('active');
        $('#fsWaypointPanel').removeClass('active');
        setTimeout(function () { map.invalidateSize(); }, 100);
    }

    // ==================== EVENT LISTENER FULLSCREEN CHANGE ====================
    function onFullscreenChange() {
        var isFs = !!(document.fullscreenElement ||
                      document.webkitFullscreenElement ||
                      document.mozFullScreenElement ||
                      document.msFullscreenElement);

        isFullscreen = isFs;

        if (isFs) {
            $('#fsToolbar').addClass('active');
            $('#fsWaypointPanel').addClass('active');
            showToast('Mode fullscreen aktif. Klik peta untuk menambah waypoint.', 'success');
        } else {
            $('#fsToolbar').removeClass('active');
            $('#fsWaypointPanel').removeClass('active');
            disableCssFullscreen();
        }

        setTimeout(function () { map.invalidateSize(); }, 200);
    }

    document.addEventListener('fullscreenchange', onFullscreenChange);
    document.addEventListener('webkitfullscreenchange', onFullscreenChange);
    document.addEventListener('mozfullscreenchange', onFullscreenChange);
    document.addEventListener('MSFullscreenChange', onFullscreenChange);

    // ==================== EVENT: TOMBOL FULLSCREEN ====================
    $('#btnFullscreen, #btnFullscreenInline').on('click', function () {
        enterFullscreen();
    });

    $('#btnFsExit').on('click', function () {
        exitFullscreen();
    });

    // ==================== EVENT: TOMBOL UNDO DI FULLSCREEN ====================
    $('#btnFsUndo').on('click', function () {
        if (waypoints.length === 0) {
            showToast('Tidak ada waypoint untuk di-undo', 'warning');
            return;
        }
        var last = waypoints[waypoints.length - 1];
        if (confirm('Hapus waypoint terakhir: "' + last.name + '"?')) {
            waypoints.pop();
            renderWaypointList();
            renderMap();
            showToast('Waypoint terakhir dihapus', 'warning');
        }
    });

    // ==================== EVENT: TOMBOL TAMBAH DARI FORM DI FULLSCREEN ====================
    $('#btnFsAddFromForm').on('click', function () {
        var name = $('#wpName').val().trim();
        var lat = parseFloat($('#wpLat').val());
        var lng = parseFloat($('#wpLng').val());

        if (!name || isNaN(lat) || isNaN(lng)) {
            showToast('Isi nama & koordinat di form utama dulu!', 'warning');
            exitFullscreen();
            setTimeout(function () {
                $('#wpName').focus();
            }, 400);
            return;
        }

        addWaypointFromData(name, $('#wpDescription').val().trim(), lat, lng);
        $('#wpName').val('');
        $('#wpDescription').val('');
        $('#wpLat').val('');
        $('#wpLng').val('');
        if (tempMarker) {
            map.removeLayer(tempMarker);
            tempMarker = null;
        }
        showToast('Waypoint "' + name + '" ditambahkan!');
    });

    // ==================== SHORTCUT KEYBOARD ====================
    $(document).on('keydown', function (e) {
        if (e.key === 'f' || e.key === 'F') {
            if (!$(e.target).is('input, textarea, select')) {
                e.preventDefault();
                if (isFullscreen) {
                    exitFullscreen();
                } else {
                    enterFullscreen();
                }
            }
        }
        if (e.key === 'Escape' && isFullscreen) {
            exitFullscreen();
        }
    });

    // ==================== EVENT: UPDATE WARNA RUTE ====================
    $('#routeColor').on('change', function () {
        renderMap();
    });

    // ==================== FUNGSI: BUILD JSON DATA ====================
    function buildJsonData() {
        return {
            route: {
                name: $('#routeName').val().trim() || 'Rute Tanpa Nama',
                description: $('#routeDescription').val().trim(),
                date: $('#routeDate').val(),
                color: $('#routeColor').val(),
                total_waypoints: waypoints.length,
                created_at: new Date().toISOString()
            },
            waypoints: waypoints.map(function (wp, index) {
                return {
                    order: index + 1,
                    name: wp.name,
                    description: wp.description,
                    latitude: wp.lat,
                    longitude: wp.lng
                };
            })
        };
    }

    // ==================== EVENT: PREVIEW JSON ====================
    $('#btnPreview').on('click', function () {
        var data = buildJsonData();
        $('#jsonPreview').text(JSON.stringify(data, null, 2));
        $('#jsonModal').modal('show');
    });

    // ==================== FUNGSI: DOWNLOAD JSON ====================
    function downloadJson() {
        var data = buildJsonData();

        if (!data.route.name || data.route.name === 'Rute Tanpa Nama') {
            if (!confirm('Nama rute belum diisi. Tetap simpan?')) {
                return;
            }
        }

        var jsonString = JSON.stringify(data, null, 2);
        var blob = new Blob([jsonString], { type: 'application/json' });
        var url = URL.createObjectURL(blob);

        var filename = (data.route.name || 'rute')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '') || 'rute';

        var a = document.createElement('a');
        a.href = url;
        a.download = filename + '.json';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);

        showToast('File JSON berhasil disimpan: ' + filename + '.json');
    }

    $('#btnSave').on('click', downloadJson);
    $('#btnDownloadFromModal').on('click', downloadJson);

    // ==================== EVENT: RESET SEMUA ====================
    $('#btnReset').on('click', function () {
        if (!confirm('Yakin ingin mereset semua data rute dan waypoint?')) {
            return;
        }

        $('#routeName').val('');
        $('#routeDescription').val('');
        $('#routeDate').val('');
        $('#routeColor').val('#007bff');

        $('#wpName').val('');
        $('#wpDescription').val('');
        $('#wpLat').val('');
        $('#wpLng').val('');

        $('#fsName').val('');
        $('#fsLat').val('');
        $('#fsLng').val('');

        waypoints = [];

        if (tempMarker) {
            map.removeLayer(tempMarker);
            tempMarker = null;
        }

        map.setView([-2.5489, 118.0149], 5);

        renderWaypointList();
        renderMap();
        showToast('Semua data berhasil direset', 'warning');
    });

    // ==================== INISIALISASI AWAL ====================
    renderWaypointList();
    renderMap();

    var today = new Date().toISOString().split('T')[0];
    $('#routeDate').val(today);
});
</script>

</body>
</html>