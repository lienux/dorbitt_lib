(function () {
    // ---------- State & Config ----------
    const PER_PAGE = 10;
    let currentPage = 1;
    let filters = { type: '', is_read: '', search: '' };

    // ---------- Utilities ----------
    function timeAgo(str) {
        if (!str) return '';
        const d = new Date(str.replace(' ', 'T'));
        const s = Math.floor((Date.now() - d.getTime()) / 1000);
        if (s < 60)    return 'baru saja';
        if (s < 3600)  return Math.floor(s / 60) + ' menit lalu';
        if (s < 86400) return Math.floor(s / 3600) + ' jam lalu';
        if (s < 604800) return Math.floor(s / 86400) + ' hari lalu';
        return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
    }

    function typeLabel(type) {
        return ({
            system_update: 'Update Sistem',
            company_info:  'Info Perusahaan',
            announcement:  'Pengumuman',
            alert:         'Peringatan',
            reminder:      'Pengingat'
        })[type] || type;
    }

    function escapeHtml(s) {
        return $('<div>').text(s == null ? '' : s).html();
    }

    // ---------- Render item (List) ----------
    function renderItem(n) {
        const unread   = parseInt(n.is_read_by_user) === 0;
        const priority = parseInt(n.priority) || 1;
        
        const borderClass = priority >= 4 ? 'border-left-danger'
                          : priority === 3 ? 'border-left-warning'
                          : 'border-left-light';

        return `
        <div class="card mb-2 shadow-sm notif-card ${unread ? 'bg-white' : 'bg-light'} ${borderClass}"
             data-id="${n.id}"
             data-title="${escapeHtml(n.title)}"
             data-message="${escapeHtml(n.message)}"
             data-action="${escapeHtml(n.action_url || '')}"
             data-label="${escapeHtml(n.action_label || '')}"
             data-created="${escapeHtml(n.created_at)}"
             data-type="${escapeHtml(n.type)}"
             style="cursor:pointer;border-left:4px solid transparent;">
            <div class="card-body py-3">
                <div class="d-flex">
                    <div class="mr-3 pt-1 text-${n.color || 'primary'}">
                        <i class="fas fa-${n.icon || 'bell'} fa-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge badge-light border text-muted mr-1">${typeLabel(n.type)}</span>
                                ${priority >= 3 ? `<span class="badge badge-${priority===4?'danger':'warning'} mr-1">${priority===4?'Urgent':'Penting'}</span>` : ''}
                                <strong class="${unread ? 'text-dark' : 'text-muted'}">${escapeHtml(n.title)}</strong>
                                ${unread ? '<span class="badge badge-primary badge-pill ml-1">baru</span>' : ''}
                            </div>
                            <small class="text-muted text-nowrap ml-2">${timeAgo(n.created_at)}</small>
                        </div>
                        <div class="text-muted mt-1 small">
                            ${escapeHtml(n.message).substring(0, 180)}${n.message.length > 180 ? '…' : ''}
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    }

    // ---------- Load List Data ----------
    function loadNotifications() {
        const $c = $('#notif-container');
        $c.html('<div class="text-center text-muted py-5"><div class="spinner-border spinner-border-sm mr-2"></div> Memuat...</div>');

        const params = {
            limit:   PER_PAGE,
            offset:  (currentPage - 1) * PER_PAGE,
            type:    filters.type,
            is_read: filters.is_read,
            search:  filters.search
        };

        // Panggil API CI4 Anda
        $.getJSON($ummu.vars.page_url + 'show', params)
            .done(function (res) {
                // Cek apakah response menggunakan 'rows' atau 'data'
                const items = res.rows || res.data || [];
                
                if (!items.length) {
                    $c.html(`
                        <div class="card shadow-sm">
                            <div class="card-body text-center text-muted py-5">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Tidak ada notifikasi${filters.type || filters.is_read || filters.search ? ' yang cocok dengan filter' : ''}.
                            </div>
                        </div>`);
                    $('#notif-pagination').empty();
                    $('#notif-summary').text('0 notifikasi');
                    return;
                }
                $c.html(items.map(renderItem).join(''));
                $('#notif-summary').text(items.length + ' notifikasi ditampilkan');
                loadCountAndPagination(params);
            })
            .fail(function () {
                $c.html('<div class="alert alert-danger">Gagal memuat notifikasi.</div>');
            });
    }

    // ---------- Count & Pagination ----------
    function loadCountAndPagination(params) {
        $.getJSON($ummu.vars.page_url + 'count', function (res) {
            const unread = res.unread || 0;
            const $summary = $('#notif-summary');
            const text = $summary.text();
            $summary.text(text + ' • ' + unread + ' belum dibaca');
        });

        // Render tombol Prev / Next sederhana
        const rendered = $('#notif-container .notif-card').length;
        const hasPrev  = currentPage > 1;
        const hasNext  = rendered === PER_PAGE;

        let html = '';
        html += `<li class="page-item ${hasPrev ? '' : 'disabled'}">
                    <a class="page-link" href="#" data-page="${currentPage - 1}">&laquo; Sebelumnya</a>
                 </li>`;
        html += `<li class="page-item disabled">
                    <span class="page-link">Halaman ${currentPage}</span>
                 </li>`;
        html += `<li class="page-item ${hasNext ? '' : 'disabled'}">
                    <a class="page-link" href="#" data-page="${currentPage + 1}">Berikutnya &raquo;</a>
                 </li>`;
        $('#notif-pagination').html(html);
    }

    // ---------- Actions ----------
    function markRead(id, $card) {
        $.post($ummu.vars.page_url + id + '/read', function () {
            $card.removeClass('bg-white').addClass('bg-light');
            $card.find('.badge-primary').remove();
            $card.find('strong').removeClass('text-dark').addClass('text-muted');
            refreshBadge();
            loadNotifications(); // Refresh data dari server
        }).fail(function() {
            console.log('Gagal menandai sudah dibaca');
        });
    }

    function refreshBadge() {
        $.getJSON($ummu.vars.page_url + 'count', function (res) {
            const $b = $('#notif-badge');
            if (res.unread > 0) $b.text(res.unread > 99 ? '99+' : res.unread).show();
            else $b.hide();
        });
    }

    // ---------- Events Initialization ----------
    $(function () {
        loadNotifications();

        // Filter Tipe & Status
        $('#filter-type, #filter-read').on('change', function () {
            filters.type    = $('#filter-type').val();
            filters.is_read = $('#filter-read').val();
            currentPage = 1;
            loadNotifications();
        });

        // Pencarian (Debounce)
        let searchTimer;
        $('#filter-search').on('input', function () {
            clearTimeout(searchTimer);
            const val = $(this).val();
            searchTimer = setTimeout(function () {
                filters.search = val;
                currentPage = 1;
                loadNotifications();
            }, 350);
        });

        // Reset Filter
        $('#btn-reset-filter').on('click', function () {
            $('#filter-type').val('');
            $('#filter-read').val('');
            $('#filter-search').val('');
            filters = { type: '', is_read: '', search: '' };
            currentPage = 1;
            loadNotifications();
        });

        // Klik Card → Buka Modal & Mark Read
        $(document).on('click', '.notif-card', function () {
            const $c = $(this);
            const id = $c.data('id');
            
            // Isi Modal
            $('#notifModalTitle').text($c.data('title'));
            $('#notifModalMessage').text($c.data('message'));
            $('#notifModalMeta').text($c.data('created') ? 'Dibuat: ' + $c.data('created') : '');

            const action = $c.data('action');
            const label  = $c.data('label');
            if (action) {
                $('#notifModalAction').attr('href', action).text(label || 'Buka').removeClass('d-none');
            } else {
                $('#notifModalAction').addClass('d-none');
            }
            
            $('#notifModal').modal('show');
            markRead(id, $c);
        });

        // Pagination Click
        $(document).on('click', '#notif-pagination a.page-link', function (e) {
            e.preventDefault();
            const p = parseInt($(this).data('page'));
            if (!p || p < 1) return;
            currentPage = p;
            loadNotifications();
            $('html, body').animate({ scrollTop: 0 }, 200);
        });

        // Mark All Read
        $('#btn-mark-all').on('click', function () {
            const $btn = $(this).prop('disabled', true);
            $.post($ummu.vars.page_url + 'read-all', function () {
                $btn.prop('disabled', false);
                loadNotifications();
                refreshBadge();
            }).fail(function () {
                $btn.prop('disabled', false);
                alert('Gagal menandai semua. Coba lagi.');
            });
        });
    });
})();