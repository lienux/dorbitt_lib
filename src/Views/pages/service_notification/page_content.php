<style>
    body {
        background: #f4f6f9;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    /* ---------- Navbar ---------- */
    .navbar-erp {
        background: #2c3e50;
        box-shadow: 0 2px 8px rgba(0,0,0,.12);
    }
    .navbar-erp .navbar-brand {
        color: #fff;
        font-weight: 600;
        letter-spacing: .5px;
    }
    .navbar-erp .nav-link {
        color: rgba(255,255,255,.75) !important;
    }
    .navbar-erp .nav-link:hover {
        color: #fff !important;
    }

    /* Badge notif di bell */
    #notif-badge {
        font-size: .65rem;
        padding: .25em .45em;
        top: 2px !important;
        right: 0 !important;
    }

    /* ---------- Notif card ---------- */
    .notif-card {
        transition: all .15s ease;
        border-left: 4px solid transparent !important;
        cursor: pointer;
    }
    .notif-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,.08) !important;
        transform: translateY(-1px);
    }
    .notif-card.border-left-danger  { border-left-color: #dc3545 !important; }
    .notif-card.border-left-warning { border-left-color: #ffc107 !important; }
    .notif-card.border-left-light   { border-left-color: #e9ecef !important; }

    .notif-card .card-body { min-height: 68px; }

    .notif-icon-wrap {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f3f5;
        flex-shrink: 0;
    }
    .notif-icon-wrap.text-success { background: #d4edda; }
    .notif-icon-wrap.text-danger  { background: #f8d7da; }
    .notif-icon-wrap.text-warning { background: #fff3cd; }
    .notif-icon-wrap.text-info    { background: #d1ecf1; }
    .notif-icon-wrap.text-primary { background: #cce5ff; }

    .notif-title {
        font-size: .95rem;
        line-height: 1.3;
    }
    .notif-message {
        font-size: .85rem;
        line-height: 1.4;
    }

    /* Dropdown notif di topbar */
    #notifDropdownMenu {
        width: 380px;
        max-height: 480px;
        overflow-y: auto;
        padding: 0;
    }
    .notif-item {
        transition: background .12s ease;
        text-decoration: none !important;
        color: inherit !important;
    }
    .notif-item:hover { background: #f1f3f5 !important; }
    .notif-item.unread { background: #f0f7ff; }

    /* Modal */
    .modal-content { border: none; border-radius: .5rem; }

    /* Pagination */
    .pagination .page-link { color: #2c3e50; }
    .pagination .page-item.active .page-link {
        background: #2c3e50;
        border-color: #2c3e50;
    }

    /* Kotak icon latar belakang */
    .notif-icon-wrap {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Perbaikan warna latar & teks agar lebih kontras */
    .notif-icon-wrap.text-success { background: #d1e7dd; color: #0f5132 !important; }
    .notif-icon-wrap.text-danger  { background: #f8d7da; color: #842029 !important; }
    .notif-icon-wrap.text-warning { background: #fff3cd; color: #664d03 !important; }
    .notif-icon-wrap.text-info    { background: #cff4fc; color: #055160 !important; }
    .notif-icon-wrap.text-primary { background: #cfe2ff; color: #084298 !important; }

    /* Ukuran icon di dalam bulatan */
    .notif-icon-wrap i {
        font-size: 1.1rem;
    }
</style>

<div class="row">
    <div class="col-lg-9">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <!-- <h4 class="mb-0">Notifikasi</h4> -->
                <small class="text-muted" id="notif-summary">Memuat...</small>
            </div>
            <button class="btn btn-outline-primary btn-sm" id="btn-mark-all">
                <i class="fas fa-check-double mr-1"></i> Tandai semua dibaca
            </button>
        </div>

        <!-- Filter -->
        <div class="card shadow-sm mb-3">
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <select id="filter-type" class="form-control form-control-sm">
                            <option value="">Semua Tipe</option>
                            <option value="system_update">Update Sistem</option>
                            <option value="company_info">Info Perusahaan</option>
                            <option value="announcement">Pengumuman</option>
                            <option value="alert">Peringatan</option>
                            <option value="reminder">Pengingat</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select id="filter-read" class="form-control form-control-sm">
                            <option value="">Semua Status</option>
                            <option value="0">Belum dibaca</option>
                            <option value="1">Sudah dibaca</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group input-group-sm">
                            <input type="text" id="filter-search" class="form-control"
                                   placeholder="Cari judul atau isi...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="btn-reset-filter">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- List -->
        <div id="notif-container">
            <div class="text-center text-muted py-5">
                <div class="spinner-border spinner-border-sm mr-2"></div> Memuat notifikasi...
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-3">
            <ul class="pagination justify-content-center mb-0" id="notif-pagination"></ul>
        </nav>

    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="notifModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notifModalTitle">-</h5>
                <button type="button" class="close ummu-close-modal" for="notifModal" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="mb-2" id="notifModalMessage">-</p>
                <small class="text-muted" id="notifModalMeta"></small>
            </div>
            <div class="modal-footer">
                <a href="#" id="notifModalAction" class="btn btn-primary btn-sm d-none">Buka</a>
                <button type="button" class="btn btn-secondary btn-sm ummu-close-modal" for="notifModal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    const API        = '<?= base_url('api/notifications') ?>';
    const PER_PAGE   = 10;
    let currentPage  = 1;
    let totalData    = 0;
    let filters      = { type: '', is_read: '', search: '' };
</script>