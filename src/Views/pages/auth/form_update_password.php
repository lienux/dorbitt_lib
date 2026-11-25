<?php
    use Dorbitt\Helpers\GviewsHelper;
    use Dorbitt\Helpers\ViewsHelper;

    $gvH = new GviewsHelper();
    $vH = new ViewsHelper();
?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <title>Perbarui Password</title>

    <!-- Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>vendor/fontawesome-6.5.1/all.css">
    <link rel="stylesheet" href="<?= $gvH->ummucssInclude() ?>">

    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('<?= env('app.bgauthimg') ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-size: 14px;
            color: #212529;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
        }

        /* Overlay gelap supaya card tetap kontras di atas background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 0;
        }

        .card-update {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            border: 1px solid #e9ecef;
            border-radius: .5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            background-color: #fff;
        }

        .card-update .card-body {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: .5rem;
            letter-spacing: -.01em;
        }

        .card-subtitle {
            font-size: .8125rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .form-label {
            font-size: .8125rem;
            font-weight: 500;
            margin-bottom: .375rem;
            color: #212529;
        }

        .form-control {
            font-size: .875rem;
            height: calc(1.5em + .75rem + 2px);
        }

        .form-control:focus {
            border-color: #212529;
            box-shadow: 0 0 0 .2rem rgba(33, 37, 41, 0.08);
        }

        /* Input group untuk toggle password */
        .input-group-text.btn-toggle {
            background: #fff;
            border-left: 0;
            cursor: pointer;
            color: #6c757d;
            padding: .375rem .75rem;
        }

        .input-group-text.btn-toggle:hover {
            color: #212529;
            background: #f8f9fa;
        }

        .input-group-text.btn-toggle svg {
            width: 16px;
            height: 16px;
        }

        /* Requirements */
        .requirements {
            list-style: none;
            padding: 0;
            margin: .5rem 0 0;
        }

        .requirements li {
            font-size: .75rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            margin-bottom: .25rem;
        }

        .requirements li::before {
            content: '';
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 1.5px solid #dee2e6;
            margin-right: .5rem;
            flex-shrink: 0;
            transition: all .15s;
        }

        .requirements li.met {
            color: #28a745;
        }

        .requirements li.met::before {
            background-color: #28a745;
            border-color: #28a745;
        }

        /* Strength bar (subtle) */
        .strength {
            display: flex;
            gap: 4px;
            margin-top: .5rem;
        }

        .strength .bar {
            flex: 1;
            height: 3px;
            background-color: #e9ecef;
            border-radius: 2px;
            transition: background-color .2s;
        }

        .strength .bar.active-weak   { background-color: #dc3545; }
        .strength .bar.active-medium { background-color: #ffc107; }
        .strength .bar.active-strong { background-color: #28a745; }

        /* Buttons */
        .btn-primary {
            background-color: #212529;
            border-color: #212529;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #000;
            border-color: #000;
        }

        .btn-primary:disabled {
            opacity: .6;
        }

        .btn-primary svg,
        .btn-link-muted svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
        }

        .btn-link-muted {
            color: #6c757d;
            font-size: .8125rem;
            padding: .375rem .75rem;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }

        .btn-link-muted:hover {
            color: #212529;
            text-decoration: none;
            background-color: #f8f9fa;
            border-radius: .25rem;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1.25rem;
            margin-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        .actions .btn-primary {
            max-width: 180px;
            flex: 1;
        }

        .invalid-feedback {
            font-size: .75rem;
        }

        .invalid-feedback.d-block {
            display: block;
        }

        .alert {
            font-size: .8125rem;
            padding: .625rem .75rem;
            margin-bottom: 1rem;
        }

        /* Modal loader */
        #loaderModal .modal-content {
            border-radius: .5rem;
        }

        #loaderModal .spinner-border {
            color: #212529 !important;
        }

        @media (max-width: 480px) {
            .card-update .card-body { padding: 1.5rem; }
            .actions {
                flex-direction: column-reverse;
            }
            .actions .btn-primary,
            .actions .btn-link-muted {
                width: 100%;
                max-width: none;
                margin-bottom: .5rem;
            }
            .actions .btn-link-muted { margin-bottom: 0; }
        }
    </style>
</head>
<body>

<div class="card card-update">
    <div class="card-body">

        <!-- Header -->
        <h1 class="card-title">Perbarui password</h1>
        <p class="card-subtitle">
            Untuk keamanan akun, kami menyarankan Anda mengganti password default.
            Anda bisa melewati langkah ini dan melakukannya nanti.
        </p>

        <!-- Alert -->
        <div id="alert" class="alert d-none" role="alert"></div>

        <!-- Form -->
        <form id="form" novalidate>
            <!-- Password lama -->
            <div class="form-group">
                <label for="oldPassword" class="form-label">Password saat ini</label>
                <div class="input-group">
                    <input type="password"
                           class="form-control"
                           id="oldPassword"
                           autocomplete="current-password"
                           placeholder="Masukkan password saat ini"
                           required>
                    <div class="input-group-append">
                        <span class="input-group-text btn-toggle"
                              onclick="toggle('oldPassword', this)"
                              title="Tampilkan password">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Password baru -->
            <div class="form-group">
                <label for="newPassword" class="form-label">Password baru</label>
                <div class="input-group">
                    <input type="password"
                           class="form-control"
                           id="newPassword"
                           autocomplete="new-password"
                           placeholder="Minimal 8 karakter"
                           required>
                    <div class="input-group-append">
                        <span class="input-group-text btn-toggle"
                              onclick="toggle('newPassword', this)"
                              title="Tampilkan password">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Strength bar -->
                <div class="strength" aria-hidden="true">
                    <div class="bar" data-bar="1"></div>
                    <div class="bar" data-bar="2"></div>
                    <div class="bar" data-bar="3"></div>
                </div>

                <!-- Requirements -->
                <ul class="requirements" id="requirements">
                    <li data-req="length">Minimal 8 karakter</li>
                    <li data-req="case">Huruf besar &amp; kecil</li>
                    <li data-req="number">Mengandung angka</li>
                </ul>
            </div>

            <!-- Konfirmasi -->
            <div class="form-group mb-0">
                <label for="confirmPassword" class="form-label">Konfirmasi password baru</label>
                <div class="input-group">
                    <input type="password"
                           class="form-control"
                           id="confirmPassword"
                           autocomplete="new-password"
                           placeholder="Ulangi password baru"
                           required>
                    <div class="input-group-append">
                        <span class="input-group-text btn-toggle"
                              onclick="toggle('confirmPassword', this)"
                              title="Tampilkan password">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="invalid-feedback" id="matchError">Password tidak cocok</div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <button type="button"
                        class="btn btn-user btn-link-muted btn-block w-100 mb-1"
                        onclick="skip()">
                    <i class="fas fa-long-arrow-alt-right"></i>
                    Lewati untuk sekarang
                </button>
                <button type="submit"
                        class="btn btn-user btn-purple btn-block w-100 mb-1"
                        id="submitBtn">
                    <i class="fas fa-save"></i>
                    <span id="submitText">Simpan password</span>
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Modal Loader -->
<div class="modal fade" id="loaderModal" tabindex="-1" role="dialog"
     data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-body text-center py-4">
                <div class="spinner-border mb-3" role="status"
                     style="width: 2.5rem; height: 2.5rem;">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mb-0 small text-muted" id="loaderMessage">Memproses...</p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 4.6 JS -->
<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const $ = (id) => document.getElementById(id);

    // ==========================================
    // Loader modal
    // ==========================================
    let loaderModal = null;

    function showLoader(message = 'Memproses...') {
        $('loaderMessage').textContent = message;
        if (!loaderModal) {
            loaderModal = new bootstrap.Modal($('loaderModal'), {
                backdrop: 'static',
                keyboard: false
            });
        }
        loaderModal.show();
    }

    function hideLoader() {
        if (loaderModal) loaderModal.hide();
    }

    // ==========================================
    // Toggle show/hide password
    // ==========================================
    function toggle(inputId, btn) {
        const input = $(inputId);
        const isPwd = input.type === 'password';
        input.type = isPwd ? 'text' : 'password';
        btn.title = isPwd ? 'Sembunyikan password' : 'Tampilkan password';
    }

    // ==========================================
    // Alert helper
    // ==========================================
    function showAlert(msg, type = 'danger') {
        const el = $('alert');
        el.className = `alert alert-${type}`;
        el.textContent = msg;
        el.classList.remove('d-none');
        if (type === 'success') {
            setTimeout(() => el.classList.add('d-none'), 4000);
        }
    }

    function hideAlert() {
        $('alert').classList.add('d-none');
    }

    // ==========================================
    // Error per-field helper
    // ==========================================
    function applyFieldErrors(errors) {
        clearFieldErrors();

        const fieldMap = {
            current_password:      'oldPassword',
            password:              'newPassword',
            password_confirmation: 'confirmPassword'
        };

        Object.entries(errors).forEach(([field, msg]) => {
            const inputId = fieldMap[field] || field;
            const input = $(inputId);
            if (!input) return;

            input.classList.add('is-invalid');

            // Tempatkan error message setelah .input-group (di dalam .form-group)
            const formGroup = input.closest('.form-group');
            if (!formGroup) return;

            let errEl = formGroup.querySelector('.invalid-feedback.field-error');
            if (!errEl) {
                errEl = document.createElement('div');
                errEl.className = 'invalid-feedback field-error d-block';
                formGroup.appendChild(errEl);
            }
            errEl.textContent = msg;
        });
    }

    function clearFieldErrors() {
        document.querySelectorAll('.form-control.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback.field-error').forEach(el => {
            el.remove();
        });
    }

    // Bersihkan error saat user mulai mengetik
    ['oldPassword', 'newPassword', 'confirmPassword'].forEach(id => {
        $(id).addEventListener('input', () => {
            const el = $(id);
            if (el.classList.contains('is-invalid')) {
                el.classList.remove('is-invalid');
                const formGroup = el.closest('.form-group');
                const errEl = formGroup?.querySelector('.invalid-feedback.field-error');
                if (errEl) errEl.remove();
            }
        });
    });

    // ==========================================
    // Validasi realtime: requirements & strength
    // ==========================================
    $('newPassword').addEventListener('input', () => {
        const val = $('newPassword').value;

        const reqs = {
            length: val.length >= 8,
            case:   /[a-z]/.test(val) && /[A-Z]/.test(val),
            number: /\d/.test(val)
        };

        Object.entries(reqs).forEach(([key, met]) => {
            const el = document.querySelector(`[data-req="${key}"]`);
            if (el) el.classList.toggle('met', met);
        });

        const score = Object.values(reqs).filter(Boolean).length;
        const bars = document.querySelectorAll('.strength .bar');
        bars.forEach((bar, i) => {
            bar.className = 'bar';
            if (i < score) {
                const cls = score === 1 ? 'active-weak'
                          : score === 2 ? 'active-medium'
                          : 'active-strong';
                bar.classList.add(cls);
            }
        });
    });

    // ==========================================
    // Validasi match konfirmasi
    // ==========================================
    function checkMatch() {
        const p1 = $('newPassword').value;
        const p2 = $('confirmPassword').value;
        const input = $('confirmPassword');
        const err = $('matchError');
        const invalid = p2.length > 0 && p1 !== p2;

        input.classList.toggle('is-invalid', invalid);
        err.classList.toggle('d-block', invalid);
        return !invalid;
    }
    $('confirmPassword').addEventListener('input', checkMatch);

    // ==========================================
    // Submit handler
    // ==========================================
    $('form').addEventListener('submit', async (e) => {
        e.preventDefault();
        hideAlert();
        clearFieldErrors();

        const oldPwd = $('oldPassword').value.trim();
        const newPwd = $('newPassword').value;
        const confirmPwd = $('confirmPassword').value;

        // Validasi client-side
        if (!oldPwd || !newPwd || !confirmPwd) {
            return showAlert('Semua kolom wajib diisi.');
        }
        if (newPwd.length < 8) {
            return showAlert('Password baru minimal 8 karakter.');
        }
        if (!checkMatch()) {
            return showAlert('Konfirmasi password tidak cocok.');
        }

        const btn = $('submitBtn');
        const btnText = $('submitText');
        btn.disabled = true;
        btnText.textContent = 'Menyimpan...';

        // Tampilkan loader modal
        showLoader('Menyimpan password...');

        try {
            const res = await fetch('<?=base_url()?>admin/config/update_password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? ''
                },
                body: JSON.stringify({
                    current_password: oldPwd,
                    password: newPwd,
                    password_confirmation: confirmPwd
                })
            });

            const data = await res.json();

            // ==========================================
            // Handle response sesuai format API
            // ==========================================
            if (data.status === true) {
                // SUCCESS
                hideLoader();
                showAlert(data.message || 'Password berhasil diperbarui.', 'success');
                setTimeout(() => window.location.href = '<?=base_url('admin')?>', 1200);
                return;
            }

            // GAGAL (status === false)
            hideLoader();
            btn.disabled = false;
            btnText.textContent = 'Simpan password';

            // Jika ada errors per-field
            if (data.errors && typeof data.errors === 'object') {
                applyFieldErrors(data.errors);

                const mainMsg = data.message || data.messages || 'Validasi gagal. Periksa kembali input Anda.';
                showAlert(mainMsg, 'danger');
                return;
            }

            // Gagal tanpa detail field
            showAlert(data.message || data.messages || 'Gagal menyimpan password.', 'danger');

        } catch (err) {
            hideLoader();
            btn.disabled = false;
            btnText.textContent = 'Simpan password';
            showAlert(err.message || 'Terjadi kesalahan. Coba lagi.', 'danger');
        }
    });

    // ==========================================
    // Skip
    // ==========================================
    function skip() {
        if (!confirm('Lewati update password? Anda tetap bisa mengubahnya nanti di pengaturan akun.')) return;

        // Opsional: beri tahu backend user sudah skip
        /*
        fetch('/api/skip-password-update', { method: 'POST' });
        */
        window.location.href = '<?=base_url('admin')?>';
    }
</script>

</body>
</html>