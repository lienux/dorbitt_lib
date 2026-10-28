<style>
    .pic-kapal-page { zpadding: 25px; margin: 0 auto; }

    .pic-kapal-page .card { background: #fff; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,.08); margin-bottom: 20px; }
    .pic-kapal-page .card-header { padding: 16px 20px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
    .pic-kapal-page .card-header h2 { font-size: 15px; font-weight: 600; margin: 0; }
    .pic-kapal-page .card-body { padding: 20px; }

    .pic-kapal-page .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; transition: .2s; }
    .pic-kapal-page .btn-primary { background: #2563eb; color: #fff; } .pic-kapal-page .btn-primary:hover { background: #1d4ed8; }
    .pic-kapal-page .btn-secondary { background: #e5e7eb; color: #374151; } .pic-kapal-page .btn-secondary:hover { background: #d1d5db; }
    .pic-kapal-page .btn-danger { background: #ef4444; color: #fff; padding: 5px 10px; font-size: 12px; } .pic-kapal-page .btn-danger:hover { background: #dc2626; }
    .pic-kapal-page .btn-sm { padding: 5px 10px; font-size: 12px; }

    .pic-kapal-page .toolbar { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 15px; }
    .pic-kapal-page .toolbar input, .pic-kapal-page .toolbar select { padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 13px; outline: none; }
    .pic-kapal-page .toolbar input { flex: 1; min-width: 200px; }

    .pic-kapal-page table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .pic-kapal-page thead { background: #f8fafc; }
    .pic-kapal-page th, .pic-kapal-page td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e5e7eb; vertical-align: top; }
    .pic-kapal-page th { font-weight: 600; color: #475569; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
    .pic-kapal-page tbody tr:hover { background: #f9fafb; }

    .pic-kapal-page .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; margin: 1px; }
    .pic-kapal-page .badge-blue { background: #dbeafe; color: #1e40af; }
    .pic-kapal-page .badge-green { background: #dcfce7; color: #166534; }
    .pic-kapal-page .badge-gray { background: #f1f5f9; color: #475569; }
    .pic-kapal-page .badge-purple { background: #ede9fe; color: #5b21b6; }
    .pic-kapal-page .badge-orange { background: #ffedd5; color: #9a3412; }

    .pic-kapal-page .loader { text-align: center; padding: 30px; color: #9ca3af; font-size: 14px; }
    .pic-kapal-page .empty { text-align: center; padding: 40px 20px; color: #9ca3af; font-size: 14px; }
    .pic-kapal-page .info-box { background: #eff6ff; border-left: 4px solid #2563eb; padding: 14px 18px; border-radius: 6px; font-size: 13px; color: #1e40af; margin-bottom: 20px; }
    .pic-kapal-page .spinner { display: inline-block; width: 14px; height: 14px; border: 2px solid #cbd5e1; border-top-color: #2563eb; border-radius: 50%; animation: pk-spin .8s linear infinite; vertical-align: middle; margin-right: 6px; }
    @keyframes pk-spin { to { transform: rotate(360deg); } }

    /* MODAL - pakai class BEDA dari Bootstrap */
    .pic-kapal-modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 99999; align-items: center; justify-content: center; padding: 20px; opacity: 0; transition: opacity .2s ease; }
    .pic-kapal-modal.active { display: flex; opacity: 1; }
    .pic-kapal-modal .pk-dialog { background: #fff; border-radius: 10px; width: 100%; max-width: 620px; max-height: 90vh; overflow-y: auto; transform: translateY(-15px); transition: transform .2s ease; box-shadow: 0 10px 40px rgba(0,0,0,.2); }
    .pic-kapal-modal.active .pk-dialog { transform: translateY(0); }
    .pic-kapal-modal .pk-header { padding: 18px 22px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; background: #fff; z-index: 2; border-radius: 10px 10px 0 0; }
    .pic-kapal-modal .pk-header h3 { font-size: 16px; margin: 0; }
    .pic-kapal-modal .pk-close { background: none; border: none; font-size: 22px; cursor: pointer; color: #6b7280; line-height: 1; }
    .pic-kapal-modal .pk-body { padding: 22px; }
    .pic-kapal-modal .pk-footer { padding: 16px 22px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 10px; position: sticky; bottom: 0; background: #fff; }
    .pic-kapal-modal .form-group { margin-bottom: 16px; }
    .pic-kapal-modal .form-group label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; color: #374151; }
    .pic-kapal-modal .form-group input[type=text], .pic-kapal-modal .form-group select { width: 100%; padding: 9px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 13px; outline: none; }
    .pic-kapal-modal .form-group input:focus, .pic-kapal-modal .form-group select:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,.1); }
    .pic-kapal-modal .scope-options { display: flex; gap: 10px; margin-top: 6px; }
    .pic-kapal-modal .scope-option { flex: 1; border: 2px solid #e5e7eb; border-radius: 8px; padding: 14px; cursor: pointer; transition: .2s; }
    .pic-kapal-modal .scope-option:hover { border-color: #93c5fd; }
    .pic-kapal-modal .scope-option.selected { border-color: #2563eb; background: #eff6ff; }
    .pic-kapal-modal .scope-option h4 { font-size: 13px; margin-bottom: 4px; }
    .pic-kapal-modal .scope-option p { font-size: 11px; color: #6b7280; margin: 0; }
    .pic-kapal-modal .vessel-checklist { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 8px; margin-top: 6px; max-height: 280px; overflow-y: auto; padding: 4px; border: 1px solid #f1f5f9; border-radius: 6px; }
    .pic-kapal-modal .vessel-item { display: flex; align-items: center; gap: 8px; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 6px; cursor: pointer; transition: .2s; font-size: 12.5px; }
    .pic-kapal-modal .vessel-item:hover { border-color: #2563eb; background: #eff6ff; }
    .pic-kapal-modal .vessel-item input { accent-color: #2563eb; }
    .pic-kapal-modal .vessel-item input:checked + span { color: #1e40af; font-weight: 600; }
    .pic-kapal-modal .info-box { background: #eff6ff; border-left: 4px solid #2563eb; padding: 14px 18px; border-radius: 6px; font-size: 13px; color: #1e40af; margin-bottom: 0; }

    .pk-toast { position: fixed; top: 20px; right: 20px; padding: 12px 20px; border-radius: 6px; color: #fff; font-size: 13px; z-index: 100000; opacity: 0; transform: translateY(-10px); transition: .3s; }
    .pk-toast.show { opacity: 1; transform: translateY(0); }
    .pk-toast.success { background: #16a34a; }
    .pk-toast.error { background: #dc2626; }
</style>

<div class="pic-kapal-page">
    <div class="info-box">
        💡 PIC dengan scope <strong>All Vessels</strong> otomatis melihat semua kapal tanpa perlu di-assign manual. Departemen otomatis mengikuti data karyawan (table <em>employee</em>).
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Daftar PIC Kapal</h2>
            <button class="btn btn-primary" id="btnAdd">+ Tambah PIC</button>
        </div>
        <div class="card-body">
            <div class="toolbar">
                <input type="text" id="searchInput" placeholder="Cari nama / username / email...">
                <select id="deptFilter">
                    <option value="">Semua Departemen</option>
                    <?php foreach ($departments as $d): ?>
                        <option value="<?= esc($d['name']) ?>"><?= esc($d['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="tableWrap">
                <div class="loader"><span class="spinner"></span> Memuat data...</div>
            </div>
        </div>
    </div>
</div>

<?= $this->include(config('Ummu')->Views($dir_views . '_form_modal')); ?>

<script>
(function () {
    function boot() {
        if (typeof window.jQuery === 'undefined') {
          return setTimeout(boot, 50);
        }
        var $ = window.jQuery;

        $(function () {
            var BASE = '<?= base_url('admin/pic_kapal') ?>';
            var allVessels = [];

            function showToast(msg, type) {
                type = type || 'success';
                var $t = $('<div class="pk-toast"></div>').addClass(type).text(msg);
                $('body').append($t);
                setTimeout(function () { $t.addClass('show'); }, 10);
                setTimeout(function () {
                    $t.removeClass('show');
                    setTimeout(function () { $t.remove(); }, 300);
                }, 2500);
            }

            function escapeHtml(s) {
                return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
                    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
                });
            }

            function loadList() {
                var $wrap = $('#tableWrap');
                $wrap.html('<div class="loader"><span class="spinner"></span> Memuat data...</div>');
                $.ajax({
                    url: BASE + '/list',
                    method: 'GET',
                    dataType: 'json',
                    data: { search: $('#searchInput').val().trim(), department: $('#deptFilter').val() },
                    success: function (json) { renderTable(json.data || []); },
                    error: function (xhr) {
                        var msg = 'Gagal memuat data';
                        try { msg = JSON.parse(xhr.responseText).error || msg; } catch (e) {}
                        $wrap.html('<div class="empty" style="color:#dc2626;">' + escapeHtml(msg) + '</div>');
                    }
                });
            }

            function renderTable(rows) {
            var $wrap = $('#tableWrap');
            if (!rows.length) {
              $wrap.html('<div class="empty">Belum ada PIC terdaftar.</div>');
              return;
            }

            var html = '<table><thead><tr>'
              + '<th style="width:40px;">No</th>'
              + '<th>Nama PIC</th>'
              + '<th>Departemen</th>'
              + '<th>Scope</th>'
              + '<th>Kapal yang Di-handle</th>'
              + '<th style="width:140px;">Aksi</th>'
              + '</tr></thead><tbody>';

            rows.forEach(function (r, i) {
              var vesselBadges;
              if (r.scope_type === 'ALL_VESSELS') {
                vesselBadges = '<span class="badge badge-green">🌐 Semua Kapal</span>';
              } else if (r.vessels && r.vessels.length) {
                vesselBadges = r.vessels.map(function (v) {
                  return '<span class="badge badge-blue">' + escapeHtml(v.name) + '</span>';
                }).join('');
              } else {
                vesselBadges = '<span class="badge badge-gray">Belum ada kapal</span>';
              }

              var deptBadge = r.department_name
                ? '<span class="badge badge-purple">' + escapeHtml(r.department_name) + '</span>'
                : '<span class="badge badge-gray">-</span>';

              var scopeBadge = r.scope_type === 'ALL_VESSELS'
                ? '<span class="badge badge-green">All Vessels</span>'
                : '<span class="badge badge-gray">By Vessel</span>';

              html += '<tr>'
                + '<td>' + (i + 1) + '</td>'
                + '<td><strong>' + escapeHtml(r.name || r.username) + '</strong><br><small style="color:#6b7280;">' + escapeHtml(r.email || '') + '</small></td>'
                + '<td>' + deptBadge + '</td>'
                + '<td>' + scopeBadge + '</td>'
                + '<td>' + vesselBadges + '</td>'
                + '<td><button class="btn btn-secondary btn-sm btn-edit" data-id="' + r.account_id + '">Edit</button> '
                + '<button class="btn btn-danger btn-del" data-id="' + r.account_id + '">Hapus</button></td>'
                + '</tr>';
            });

            html += '</tbody></table>';
            $wrap.html(html);
            }

            function loadVessels() {
            if (allVessels.length) return $.Deferred().resolve(allVessels).promise();
            return $.ajax({ url: BASE + '/vessels', method: 'GET', dataType: 'json' })
              .then(function (json) {
                allVessels = json.data || [];
                return allVessels;
              });
            }

            function openModal() {
            $('#modalPIC').addClass('active');
            $('body').css('overflow', 'hidden');
            }
            function closeModal() {
            $('#modalPIC').removeClass('active');
            $('body').css('overflow', '');
            }
            window.closeModal = closeModal;
            window.setScope = setScope;

            function setScope(type) {
            $('#scopeType').val(type);
            $('.scope-option').each(function () {
              $(this).toggleClass('selected', $(this).data('scope') === type);
            });
            $('#vesselSection').toggle(type === 'BY_VESSEL');
            $('#allVesselNote').toggle(type === 'ALL_VESSELS');
            }

            function loadAvailableAccounts() {
            var $sel = $('#accountSelect');
            $sel.html('<option value="">-- Pilih Akun --</option>');
            $.ajax({
              url: BASE + '/available-accounts',
              method: 'GET',
              dataType: 'json',
              success: function (json) {
                (json.data || []).forEach(function (a) {
                  var label = (a.id) + ' - ' + (a.name || a.username) + ' (' + (a.email || '-') + ')'
                    + (a.department_name ? ' — ' + a.department_name : '');
                  $sel.append($('<option>').val(a.id).text(label));
                });
              }
            });
            }

            function renderVesselChecklist(selectedIds) {
            selectedIds = selectedIds || [];
            var $wrap = $('#vesselChecklist');
            var sel = selectedIds.map(Number);

            if (!allVessels.length) {
              $wrap.html('<div class="empty" style="padding:15px;font-size:12px;">Tidak ada kapal</div>');
              return;
            }

            var html = '';
            allVessels.forEach(function (v) {
              var checked = sel.indexOf(Number(v.id)) !== -1 ? 'checked' : '';
              html += '<label class="vessel-item"><input type="checkbox" value="' + v.id + '" ' + checked + '><span>🚢 ' + escapeHtml(v.name) + '</span></label>';
            });
            $wrap.html(html);
            }

            $('#btnAdd').on('click', function () {
            $('#modalTitle').text('Tambah PIC Kapal');
            $('#formPic')[0].reset();
            $('#accountId').val('');
            $('#accountSelectWrap').show();
            $('#accountInfoWrap').hide();
            loadAvailableAccounts();
            loadVessels().then(function () { renderVesselChecklist([]); });
            setScope('BY_VESSEL');
            openModal();
            });

            $(document).on('click', '.btn-edit', function () {
            var accountId = $(this).data('id');
            $.ajax({
              url: BASE + '/detail/' + accountId,
              method: 'GET',
              dataType: 'json',
              success: function (json) {
                if (!json.data) return showToast('Data tidak ditemukan', 'error');
                var d = json.data;

                $('#modalTitle').text('Edit PIC Kapal');
                $('#accountId').val(d.account_id);
                $('#accountSelectWrap').hide();
                $('#accountInfoWrap').show();
                $('#accountInfo').html(
                  '<strong>' + escapeHtml(d.name || d.username) + '</strong><br>' +
                  '<small style="color:#6b7280;">' + escapeHtml(d.email || '') +
                  (d.department_name ? ' · ' + escapeHtml(d.department_name) : '') + '</small>'
                );

                loadVessels().then(function () {
                  renderVesselChecklist((d.vessels || []).map(function (v) { return v.id; }));
                });
                setScope(d.scope_type || 'BY_VESSEL');
                openModal();
              },
              error: function () { showToast('Gagal memuat detail PIC', 'error'); }
            });
            });

            $(document).on('click', '.scope-option', function () { setScope($(this).data('scope')); });

            $('#formPic').on('submit', function (e) {
            e.preventDefault();
            var accountId = $('#accountId').val() || $('#accountSelect').val();
            if (!accountId) return showToast('Pilih akun terlebih dahulu', 'error');

            var scopeType = $('#scopeType').val();
            var vesselIds = scopeType === 'BY_VESSEL'
              ? $('#vesselChecklist input:checked').map(function () { return this.value; }).get()
              : [];

            if (scopeType === 'BY_VESSEL' && !vesselIds.length) {
              return showToast('Pilih minimal 1 kapal', 'error');
            }

            var $btn = $('#btnSave');
            $btn.prop('disabled', true).html('<span class="spinner"></span> Menyimpan...');

            $.ajax({
              url: BASE + '/save',
              method: 'POST',
              dataType: 'json',
              data: { account_id: accountId, scope_type: scopeType, vessel_ids: vesselIds },
              success: function (json) {
                showToast(json.message || 'Berhasil', 'success');
                closeModal();
                loadList();
              },
              error: function (xhr) {
                var msg = 'Gagal menyimpan';
                try { msg = JSON.parse(xhr.responseText).error || msg; } catch (e) {}
                showToast(msg, 'error');
              },
              complete: function () { $btn.prop('disabled', false).text('Simpan'); }
            });
            });

            $(document).on('click', '.btn-del', function () {
            var accountId = $(this).data('id');
            if (!confirm('Yakin hapus PIC ini?')) return;
            $.ajax({
              url: BASE + '/delete/' + accountId,
              method: 'DELETE',
              dataType: 'json',
              success: function (json) { showToast(json.message || 'Berhasil dihapus', 'success'); loadList(); },
              error: function (xhr) {
                var msg = 'Gagal hapus';
                try { msg = JSON.parse(xhr.responseText).error || msg; } catch (e) {}
                showToast(msg, 'error');
              }
            });
            });

            $(document).on('click', '.pk-close', closeModal);
            $(document).on('click', '.pic-kapal-modal', function (e) {
            if (e.target === this) closeModal();
            });
            $(document).on('keydown', function (e) { if (e.key === 'Escape') closeModal(); });

            var searchTimer;
            $('#searchInput').on('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(loadList, 350);
            });
            $('#deptFilter').on('change', loadList);

            loadList();
        });
    }
    boot();
})();
</script>