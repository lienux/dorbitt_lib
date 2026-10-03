<?= (isset($page_content_title)) ? $page_content_title : '' ?>

<style>
    /* ============================================
       BASE STYLES
       ============================================ */
    .text-sm {
        font-size: 14px;
        line-height: 16.8px;
    }

    .modal-fullscreen .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    .btn-close {
        box-sizing: content-box;
        width: 1em;
        height: 1em;
        padding: 0.25em 0.25em;
        color: #000;
        background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
        border: 0;
        border-radius: 0.25rem;
        opacity: 0.5;
    }

    .btn-close:hover {
        color: #000;
        text-decoration: none;
        opacity: 0.75;
    }

    .btn-close:focus {
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        opacity: 1;
    }

    .btn-close:disabled,
    .btn-close.disabled {
        pointer-events: none;
        user-select: none;
        opacity: 0.25;
    }

    .btn-close-white {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* Tab Page */
    #dorbitt_tab_page ul {
        background-color: #D6EAF8;
        border: 0px;
    }

    #dorbitt_tab_page button {
        cursor: pointer;
        background-color: transparent;
        font-size: .85rem;
    }

    #dorbitt_tab_page button.active {
        border-bottom: 2px solid #3498DB;
        margin-bottom: 1px;
    }

    .qtext-10 {
        font-size: 10px;
    }

    td.highlight {
        background-color: rgba(var(--dt-row-hover), 0.052) !important;
    }

    .select2 {
        width: 100% !important;
    }

    .note-editor {
        width: 100%;
    }

    .note-editable {
        margin-top: 32px;
    }

    /* DataTables */
    table.dataTable>thead>tr>th {
        padding: 4px 8px;
    }

    table.dataTable>tbody>tr>td {
        padding: 4px 8px;
    }

    .dataTables_scroll {
        overflow: auto;
    }

    .popover {
        z-index: 9999;
    }

    .datepicker {
        z-index: 19999 !important;
    }

    .ui-datepicker {
        z-index: 1151 !important;
    }

    /* ============================================
       FREIGHT CHARTER - MODERN FORM STYLE
       (Konsisten dengan Shipping Instruction)
       ============================================ */
    :root {
        --fc-primary: #2c0074;
        --fc-primary-light: #4a1a9e;
        --fc-accent: #00c9a7;
        --fc-border: #e3e6f0;
        --fc-text-muted: #858796;
        --fc-radius: 10px;
        --fc-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        --fc-auto-bg: #f0fdf9;
    }

    .fc-form-wrapper {
        background: #f8f9fc;
        padding: 1rem;
        /*border-radius: var(--fc-radius);*/
    }

    .fc-section {
        background: #fff;
        border: 1px solid var(--fc-border);
        border-radius: var(--fc-radius);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
        box-shadow: var(--fc-shadow);
        transition: box-shadow 0.2s ease;
        height: 100%;
    }

    .fc-section:hover {
        box-shadow: 0 4px 16px rgba(44, 0, 116, 0.08);
    }

    .fc-section-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f3f9;
    }

    .fc-section-header .fc-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--fc-primary), var(--fc-primary-light));
        color: #fff;
        border-radius: 8px;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .fc-section-header h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--fc-primary);
        letter-spacing: 0.3px;
    }

    .fc-section-header small {
        color: var(--fc-text-muted);
        font-size: 0.75rem;
        margin-left: auto;
    }

    .fc-field {
        margin-bottom: 1rem;
    }

    .fc-field:last-child {
        margin-bottom: 0;
    }

    .fc-field label {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #5a5c69;
        margin-bottom: 0.35rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .fc-field label .req {
        color: #e74a3b;
        margin-left: 2px;
    }

    .fc-badge-auto {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.6rem;
        font-weight: 700;
        background: #d1f2eb;
        color: #0e8f71;
        padding: 0.15rem 0.45rem;
        border-radius: 4px;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .fc-badge-auto i {
        font-size: 0.55rem;
    }

    .fc-field .form-control,
    .fc-field .custom-select {
        border-radius: 8px;
        border: 1.5px solid var(--fc-border);
        font-size: 0.875rem;
        padding: 0.55rem 0.85rem;
        transition: all 0.15s ease;
        background: #fcfcfd;
        height: auto;
    }

    .fc-field .form-control:focus {
        border-color: var(--fc-primary);
        box-shadow: 0 0 0 3px rgba(44, 0, 116, 0.1);
        background: #fff;
    }

    .fc-field .form-control:disabled {
        background: #f1f3f9;
        cursor: not-allowed;
    }

    /* Auto-filled field (read only from parent) */
    .fc-field.auto-filled .form-control {
        background: var(--fc-auto-bg);
        color: #0e8f71;
        font-weight: 600;
        border-color: #c3e6db;
    }

    .fc-field .input-group .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .fc-field .input-group .btn-browse {
        border: 1.5px solid var(--fc-border);
        border-left: 0;
        border-radius: 0 8px 8px 0;
        background: #f8f9fc;
        color: var(--fc-primary);
        padding: 0 0.85rem;
        transition: all 0.15s ease;
        font-size: 0.875rem;
    }

    .fc-field .input-group .btn-browse:hover:not(:disabled) {
        background: var(--fc-primary);
        color: #fff;
    }

    .fc-field .input-group .btn-browse:disabled {
        opacity: 0.5;
    }

    /* Input with unit suffix (qty + uom) */
    .fc-field .input-group .input-group-text {
        border: 1.5px solid var(--fc-border);
        border-left: 0;
        border-radius: 0 8px 8px 0;
        background: #f1f3f9;
        font-weight: 700;
        color: var(--fc-primary);
        font-size: 0.8rem;
        min-width: 55px;
        justify-content: center;
    }

    /* File Upload Drop Zone */
    .fc-file-drop {
        border: 2px dashed var(--fc-border);
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        background: #fcfcfd;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .fc-file-drop:hover {
        border-color: var(--fc-primary);
        background: #f8f6ff;
    }

    .fc-file-drop.disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }

    .fc-file-drop .file-icon {
        font-size: 1.5rem;
        color: var(--fc-primary);
        margin-bottom: 0.35rem;
    }

    .fc-file-drop .file-label {
        font-size: 0.8rem;
        color: var(--fc-text-muted);
    }

    .fc-file-drop .file-name {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--fc-primary);
        margin-top: 0.35rem;
        word-break: break-all;
    }

    /* Toolbar Action */
    .fc-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        background: #fff;
        border-radius: var(--fc-radius);
        box-shadow: var(--fc-shadow);
        margin-bottom: 1.25rem;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .fc-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.45rem 0.9rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1.5px solid transparent;
        transition: all 0.15s ease;
        cursor: pointer;
        white-space: nowrap;
    }

    .fc-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    .fc-btn-primary {
        background: linear-gradient(135deg, var(--fc-primary), var(--fc-primary-light));
        color: #fff;
    }

    .fc-btn-primary:hover:not(:disabled) {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(44, 0, 116, 0.25);
        color: #fff;
    }

    .fc-btn-outline {
        background: #fff;
        border-color: var(--fc-border);
        color: #5a5c69;
    }

    .fc-btn-outline:hover:not(:disabled) {
        border-color: var(--fc-primary);
        color: var(--fc-primary);
        background: #f8f6ff;
    }

    .fc-btn-danger {
        background: #fff;
        border-color: #f8d7da;
        color: #e74a3b;
    }

    .fc-btn-danger:hover:not(:disabled) {
        background: #e74a3b;
        color: #fff;
        border-color: #e74a3b;
    }

    .fc-btn-success {
        background: #fff;
        border-color: #d4edda;
        color: #1cc88a;
    }

    .fc-btn-success:hover:not(:disabled) {
        background: #1cc88a;
        color: #fff;
        border-color: #1cc88a;
    }

    /* Metadata Footer */
    .fc-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.5rem;
    }

    .fc-meta-item {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 0.6rem 0.85rem;
        background: #f8f9fc;
        border-radius: 8px;
        color: #5a5c69;
    }

    .fc-meta-item i {
        color: var(--fc-primary);
        width: 20px;
        text-align: center;
        font-size: 0.9rem;
    }

    .fc-meta-item .meta-label {
        font-weight: 600;
        font-size: 0.65rem;
        text-transform: uppercase;
        color: var(--fc-text-muted);
        letter-spacing: 0.3px;
    }

    .fc-meta-item .meta-value {
        font-weight: 600;
        color: #2c0074;
        font-size: 0.85rem;
        word-break: break-word;
    }

    /* SB Toolbar Mobile (fallback) */
    @media (max-width: 767.98px) {
        .sb-toolbar {
            position: relative;
        }

        .toolbar-buttons {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            background-color: #ffffff;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            flex-direction: column;
            min-width: 160px;
        }

        .toolbar-buttons.show {
            display: flex !important;
        }

        .toolbar-buttons .btn {
            width: 100%;
            text-align: left;
            margin-bottom: 4px !important;
        }
    }

    @media (min-width: 768px) {
        .toolbar-buttons {
            display: inline-flex !important;
            flex-wrap: wrap;
            gap: 4px;
        }
    }

    /* Responsive */
    @media (max-width: 575.98px) {
        .fc-form-wrapper {
            padding: 0.75rem;
        }

        .fc-section {
            padding: 1rem;
        }

        .fc-toolbar {
            position: relative;
            padding: 0.5rem;
        }

        .fc-toolbar .fc-btn {
            flex: 1 1 calc(50% - 0.5rem);
            justify-content: center;
            font-size: 0.75rem;
            padding: 0.5rem;
        }
    }
</style>

<div id="ummuPageContent">
    <nav class="ummu-nav">
        <div class="nav nav-tabs" id="ummu_nav_tab">
            <button class="nav-link btn-nav-link-form mr-1 active" id="nav-tab-form" data-toggle="tab" data-target="#nav-form" type="button"
                role="tab" aria-selected="true">
                <span class="d-none d-sm-block"><i class="far fa-clipboard-list"></i> Form</span>
                <span class="d-block d-sm-none"><i class="far fa-clipboard-list"></i></span>
            </button>
            <button class="nav-link btn-nav-link-table mr-1" id="nav-tab-listData" data-toggle="tab" data-target="#nav-listData" type="button" role="tab"
                aria-selected="false">
                <span class="d-none d-sm-block"><i class="far fa-list-alt"></i> List Data</span>
                <span class="d-block d-sm-none"><i class="far fa-list-alt"></i></span>
            </button>
        </div>
    </nav>
    <div class="section-body">
        <div class="tab-content" id="ummu_tab_content">
            <div class="tab-pane fade show active" id="nav-form" role="tabpanel">
                <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
                    <div class="card-body pt-2">
                        <div class="mt-2 fc-form-wrapper">
                            <div class="alert text-light collapse" id="alert_input"></div>
                            <!-- SB Button -->
                            <?=$this->include(config('Ummu')->Views('partials/sb_button'))?>

                            
                                <?= $this->include(config('Ummu')->Views($dir_views . 'form')) ?>
                            <!-- </div> -->

                            <!-- SECTION 3: Metadata (Full Width) -->
                            <div class="fc-section mt-3">
                                <div class="fc-section-header">
                                    <span class="fc-icon"><i class="fas fa-history"></i></span>
                                    <h6>Riwayat Data</h6>
                                    <small>Audit Trail</small>
                                </div>

                                <div class="fc-meta">
                                    <div class="fc-meta-item">
                                        <i class="fas fa-calendar-plus"></i>
                                        <div>
                                            <div class="meta-label">Created At</div>
                                            <div class="meta-value" id="created_at">-</div>
                                        </div>
                                    </div>
                                    <div class="fc-meta-item">
                                        <i class="fas fa-calendar-check"></i>
                                        <div>
                                            <div class="meta-label">Updated At</div>
                                            <div class="meta-value" id="updated_at">-</div>
                                        </div>
                                    </div>
                                    <div class="fc-meta-item">
                                        <i class="fas fa-user-plus"></i>
                                        <div>
                                            <div class="meta-label">Created By</div>
                                            <div class="meta-value" id="created_by">-</div>
                                        </div>
                                    </div>
                                    <div class="fc-meta-item">
                                        <i class="fas fa-user-edit"></i>
                                        <div>
                                            <div class="meta-label">Updated By</div>
                                            <div class="meta-value" id="updated_by">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <ul class="list-group text-muted small">
                                    <li class="list-group-item py-1">
                                        <i class="fas fa-calendar-plus"></i> Created at : <span class="badge badge-info" id="created_at"></span>
                                    </li>
                                    <li class="list-group-item py-1">
                                        <i class="fas fa-calendar-check"></i> Updated at : <span class="badge badge-info" id="updated_at"></span>
                                    </li>
                                    <li class="list-group-item py-1">
                                        <i class="fas fa-user-plus"></i> Created by : <span class="badge badge-info" id="created_by"></span>
                                    </li>
                                    <li class="list-group-item py-1">
                                        <i class="fas fa-user-edit"></i> Updated by : <span class="badge badge-info" id="updated_by"></span>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-6 col-sm-12"></div>
                        </div> -->

                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info mb-0 text-sm">
                                    <i class="fas fa-info-circle"></i>
                                    Field bertanda <span class="text-danger font-weight-bold">*</span> wajib diisi.
                                    Field dengan badge <span class="fc-badge-auto"><i class="fas fa-bolt"></i> Auto</span> akan terisi otomatis <!-- setelah memilih Shipment (SI) -->.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="nav-listData" role="tabpanel">
                <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
                    <div class="card-body pt-2">
                        <?php
                            if (is_file(VENDORPATH . 'dorbitt/lib/src/Views/' . $dir_views . 'table.php')) {
                                echo $this->include(config('Ummu')->Views($dir_views . 'table'));
                            }else{
                                echo $this->include(config('Ummu')->Views('partials/table'));
                            }
                        ?>
                        <div class="pt-2" id="dtNote">
                            <div class="alert alert-warning collapse" role="alert" id="info_localStorage_true">
                                Anda mengaktifkan penyimpanan data sementara pada localStorage, untuk mendapatkan data terbaru silahkan klik button <span class='font-weight-bold text-danger'>Get Data</span> di atas
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('partials/modal') ?>
</div>