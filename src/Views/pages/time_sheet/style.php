<style>
    body { background:#f4f6f9; font-size:14px; }
    .card { border-radius:.5rem; box-shadow:0 1px 3px rgba(0,0,0,.08); }
    .card-header { background:#fff; border-bottom:2px solid #e9ecef; font-weight:600; }
    .ijo-badge {
        background: linear-gradient(135deg,#007bff,#0056b3);
        color:#fff; padding:.6rem 1rem; border-radius:.4rem;
        display:flex; align-items:center; justify-content:space-between;
        flex-wrap:wrap; gap:.75rem;
    }
    .ijo-badge .label { font-size:.75rem; opacity:.85; text-transform:uppercase; letter-spacing:.5px; }
    .ijo-badge .value { font-size:1.05rem; font-weight:700; }
    .vessel-info {
        background:#f8f9fa; border:1px solid #e9ecef; border-radius:.4rem;
        padding:.75rem 1rem; display:flex; gap:1.5rem; flex-wrap:wrap;
    }
    .vessel-info .item { display:flex; flex-direction:column; }
    .vessel-info .item .lbl { font-size:.7rem; color:#6c757d; text-transform:uppercase; letter-spacing:.4px; }
    .vessel-info .item .val { font-weight:600; color:#212529; font-size:.95rem; }
    .vessel-info .item .val i { color:#007bff; margin-right:.35rem; }
    .status-badge { font-size:.72rem; padding:.3rem .6rem; border-radius:.25rem; }
    .table thead th { background:#f8f9fa; font-size:.78rem; text-transform:uppercase; letter-spacing:.4px; color:#6c757d; border-top:none; }
    .required::after { content:" *"; color:#dc3545; }
    .form-section-title {
        font-size:.85rem; font-weight:600; color:#495057;
        text-transform:uppercase; letter-spacing:.5px;
        margin:1rem 0 .75rem; padding-bottom:.4rem; border-bottom:1px dashed #dee2e6;
    }
    .btn-xs { padding:.15rem .5rem; font-size:.72rem; line-height:1.3; border-radius:.2rem; }
    #coordStatus { display:block; margin-top:.25rem; }
    #coordStatus.success { color:#28a745 !important; }
    #coordStatus.error { color:#dc3545 !important; }
    .coord-box { background:#f8f9fa; border:1px dashed #ced4da; border-radius:.35rem; padding:.6rem .75rem; }
    .format-switch { display:inline-flex; background:#e9ecef; border-radius:.35rem; padding:2px; font-size:.72rem; }
    .format-switch button { border:none; background:transparent; color:#495057; padding:.2rem .55rem; border-radius:.25rem; font-weight:600; cursor:pointer; transition:all .15s; }
    .format-switch button.active { background:#007bff; color:#fff; box-shadow:0 1px 2px rgba(0,0,0,.15); }
    .coord-format-section { display:none; }
    .coord-format-section.active { display:block; }
    .dms-input { text-align:center; padding:.25rem .3rem; font-size:.8rem; }
    .dms-suffix { background:#e9ecef; font-size:.72rem; }
    .pic-info {
        display:inline-flex; align-items:center;
        background:#eaf7ee; color:#155724;
        font-size:.72rem; padding:.15rem .5rem;
        border-radius:.25rem; border:1px solid #c3e6cb;
    }
    .pic-info i { margin-right:.3rem; color:#28a745; }
    .pic-info strong { color:#155724; margin-left:.15rem; }
    #waPreview { font-family:'Segoe UI',Tahoma,sans-serif; line-height:1.6; color:#1a1a1a; resize:none; }
    .btn-wa { background:#25D366; border-color:#25D366; color:#fff; }
    .btn-wa:hover { background:#1da851; border-color:#1da851; color:#fff; }
    .eta-box { background:#fff8e1; border:1px dashed #ffc107; border-radius:.35rem; padding:.5rem .75rem; }
    .eta-box .eta-label { font-size:.72rem; color:#856404; text-transform:uppercase; letter-spacing:.4px; font-weight:600; }
    #timesheetList td { vertical-align: middle; word-wrap: break-word; min-width: 80px; }

    /* SIDE PANEL MODAL */
    .modal.right .modal-dialog {
        position: fixed; margin: auto; width: 520px; max-width: 100%;
        height: 100%; right: 0; top: 0; bottom: 0;
        transform: translate3d(100%, 0, 0);
        transition: transform 0.3s ease-out;
        display: flex; flex-direction: column;
    }
    .modal.right.show .modal-dialog { transform: translate3d(0, 0, 0); }
    .modal.right .modal-content { height: 100%; border-radius: 0; border: none; overflow-y: hidden; }
    .modal.right .modal-body { overflow-y: auto; }
    .modal.right.fade .modal-dialog { transition: transform 0.3s ease-out; }
    .modal.right.fade.show .modal-dialog { transform: translate3d(0, 0, 0); }
    @media (max-width: 576px) { .modal.right .modal-dialog { width: 100%; } }

    /* Select2 */
    .select2-container--default .select2-selection--single {
        height: calc(1.5em + .5rem + 2px) !important;
        padding: .25rem .5rem !important;
        border: 1px solid #ced4da !important;
        border-radius: .2rem !important;
        background-color: #fff;
        display: flex; align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #495057 !important; padding-left: 0 !important; line-height: normal !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100% !important; top: 0 !important; right: 5px !important;
    }
    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #80bdff !important;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25) !important;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #007bff !important; color: white !important;
    }

    /* IJO Selector */
    .ijo-selector-card {
        background: #fff; border: 2px solid #007bff;
        border-radius: .5rem; padding: 1rem;
        box-shadow: 0 2px 8px rgba(0,123,255,.15);
    }
    .ijo-selector-card label { font-weight: 700; color: #007bff; font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; }

    .filter-toolbar {
        background:#f8f9fa; border-radius:.35rem;
        padding:.5rem .75rem; display:flex; flex-wrap:wrap; gap:.5rem; align-items:center;
    }
    .filter-toolbar .form-control-sm { max-width: 200px; }

    /* Pagination */
    .pagination { margin-bottom: 0; display: flex; padding-left: 0; list-style: none; border-radius: .25rem; }
    .pagination li { display: inline-block; margin: 0 2px; }
    .pagination li a, .pagination li span {
        position: relative; display: block; padding: .35rem .65rem; margin-left: -1px;
        line-height: 1.25; color: #007bff !important; background-color: #fff !important;
        border: 1px solid #dee2e6 !important; border-radius: .2rem;
        font-size: 0.85rem; text-decoration: none;
    }
    .pagination li a:hover { z-index:2; color:#0056b3!important; background-color:#e9ecef!important; border-color:#dee2e6!important; }
    .pagination li.active a, .pagination li.active span { z-index:3; color:#fff!important; background-color:#007bff!important; border-color:#007bff!important; }
    .pagination li.disabled a, .pagination li.disabled span { color:#6c757d!important; pointer-events:none; background-color:#fff!important; border-color:#dee2e6!important; }

    /* IJO search hint */
    .ijo-meta-badges { display:flex; gap:.35rem; flex-wrap:wrap; margin-top:.35rem; }
    .ijo-meta-badges .badge { font-size:.68rem; padding:.25rem .5rem; font-weight:500; }

    /* IJO Loader Modal */
    #ijoLoadingModal .modal-content {
        background: #fff;
        border-radius: .75rem;
        overflow: hidden;
    }
    #ijoLoadingModal .modal-content::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, #007bff, #00c6ff, #007bff);
        background-size: 200% 100%;
        animation: ijoLoadingBar 1.5s linear infinite;
    }
    @keyframes ijoLoadingBar {
        0%   { background-position: 0% 0%; }
        100% { background-position: 200% 0%; }
    }
</style>