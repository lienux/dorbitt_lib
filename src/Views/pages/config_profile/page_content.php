<?= $this->extend('layout/' . config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
    <style>
        .profile .profile-overview .row {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .profile .profile-overview .card-title {
            color: #012970;
        }

        .profile .profile-overview .label {
            font-weight: 600;
            color: rgba(1, 41, 112, 0.6);
        }

        /* Tombol toggle password */
        .btn-toggle-password {
            border: 1px solid #ced4da;
            border-left: 0;
            background-color: #fff;
            color: #6c757d;
            padding: .25rem .5rem;
            line-height: 1;
        }

        .btn-toggle-password:hover {
            background-color: #f8f9fa;
            color: #212529;
        }

        .btn-toggle-password:focus {
            box-shadow: none;
            outline: none;
        }

        /* Pesan error di bawah input password */
        .password-mismatch {
            font-size: 12px;
            color: #dc3545;
            margin-top: 4px;
            display: none;
        }

        .password-mismatch.show {
            display: block;
        }

        /* Avatar dummy */
        .ummu-thumbnail .portrait {
            background-color: #e9ecef;
            object-fit: cover;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <div class="ummu-thumbnail">
                            <!-- Dummy avatar: akan diganti otomatis oleh file JS Anda setelah API selesai load -->
                            <img src="<?= base_url('uploads/no_image.jpg') ?>"
                                 onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=User&background=dee2e6&color=6c757d&size=200';"
                                 class="portrait" id="img_avatar_view" alt="Image" />
                        </div>
                        <h2 id="img_name_view">Memuat data...</h2>
                        <h3 id="img_jabatan_view"></h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="text-right my-2">
                    <button class="btn btn-sm btn-success" id="btn_reload_profile"><i class="fas fa-sync-alt"></i> Reload</button>
                </div>
            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item mr-1">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item mr-1">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item mr-1">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">Settings</button>
                            </li>

                            <li class="nav-item mr-1">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <!-- Overview -->
                            <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">
                                <!-- <h5 class="card-title">About</h5>
                                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque
                                    temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae
                                    quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                                <!-- <h5 class="card-title">Profile Details</h5> -->

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Profile Image</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_image"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Company Name</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_company_name"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">No. Induk Karyawan</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_nika"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_nama_lengkap"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Golongan</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_golongan"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jabatan</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_jabatan"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Department</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_department_name"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Site</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_site"><!-- 
                                        <?//= session()->get('kode_site') . ' | ' . session()->get('region_name') . ' | ' . session()->get('kode_site2') ?> -->
                                    </div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div> -->

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_alamat"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_phone_number"></div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div> -->

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">HERP Sync</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_herp_sync"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email Office</div>
                                    <div class="col-lg-9 col-md-8" id="overview_profile_email_office"></div>
                                </div>

                                <?php if (ENVIRONMENT == 'development') { ?>
                                    <div class="row">
                                        <label class="col-md-4 col-lg-3 label">Token</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="token" type="text" class="form-control text-muted" id="token"
                                                style="font-size: 10px;" readonly
                                                disabled><?= session()->get('token') ?></textarea>
                                            <button type="button" class="btn btn-outline-secondary btn-sm mt-1"
                                                data-toggle="tooltip" data-placement="top" title="Copy Token"
                                                onClick="$ummu.func.copyText('token')" id="btn_copy_token">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                            <span class="font-italic" id="token_alert_copy" style="font-size: 10px;"></span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Edit Profile -->
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form>
                                    <div class="row mb-1">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-group">
                                                <img src="<?= base_url('uploads/no_image.jpg') ?>"
                                                    class="img-thumbnail img-show-mygallery imgcl" alt="..." width="100px"
                                                    id="img_foto_avatar" data-inputid="foto_avatar"
                                                    data-imageid="img_foto_avatar">
                                                <div for="" class="text-xs text-danger lbl-info">Klik bingkai untuk memilih foto</div>
                                                <div class="input-group input-group-sm mb-3 collapse">
                                                    <input type="text" class="form-control" id="foto_avatar" readonly
                                                        disabled>
                                                    <div class="input-group-append">
                                                        <button
                                                            class="btn btn-outline-secondary btn_show_gallery btn-show-mygallery"
                                                            type="button" id="btn_image" data-inputid="foto_avatar"
                                                            data-imageid="img_foto_avatar">Choose File</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="row mb-1">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fullName" type="text" class="form-control form-control-sm"
                                                id="fullName">
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="about" class="form-control form-control-sm"
                                                id="about"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="company" type="text" class="form-control" id="company">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="job" type="text" class="form-control" id="Job">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="country" type="text" class="form-control" id="Country">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Address">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email">
                                        </div>
                                    </div> -->

                                    <div class="row mb-3">
                                        <label for="email_office" class="col-md-4 col-lg-3 col-form-label">Email
                                            Office</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email_office" type="email_office"
                                                class="form-control form-control-sm" id="email_office">
                                        </div>
                                    </div>

                                    <!-- <div class="row mb-3">
                                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="twitter" type="text" class="form-control" id="Twitter">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="facebook" type="text" class="form-control" id="Facebook">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="instagram" type="text" class="form-control" id="Instagram">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="linkedin" type="text" class="form-control" id="Linkedin">
                                        </div>
                                    </div> -->

                                    <div class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" id="btn_update_profile">Save
                                            Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>

                            <!-- Settings -->
                            <div class="tab-pane fade pt-3" id="profile-settings">
                                <!-- Settings Form -->
                                <form>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                            Notifications</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                <label class="form-check-label" for="changesMade">
                                                    Changes made to your account
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                <label class="form-check-label" for="newProducts">
                                                    Information on new products and services
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="proOffers">
                                                <label class="form-check-label" for="proOffers">
                                                    Marketing and promo offers
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="securityNotify" checked
                                                    disabled>
                                                <label class="form-check-label" for="securityNotify">
                                                    Security alerts
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" id="btn_update_setting">Save
                                            Changes</button>
                                    </div>
                                </form><!-- End settings Form -->
                                <hr>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">HERP Sync</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" name="username_herp" class="form-control form-control-sm mb-1"
                                            id="username_herp" placeholder="Username">
                                        <div class="input-group input-group-sm mb-1">
                                            <input type="password" name="password_herp" class="form-control form-control-sm" id="password_herp"
                                                placeholder="Password">
                                            <button type="button" class="btn btn-toggle-password btn-toggle-pwd" tabindex="-1"
                                                data-target="password_herp" title="Tampilkan password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <div class="text-danger small">* Bukan untuk login ke aplikasi web ini.</div>
                                        <button class="btn btn-sm btn-primary" id="btn_sysnc_to_herp">Sync</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form>

                                    <div class="row mb-1">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group input-group-sm">
                                                <input name="password" type="password" class="form-control form-control-sm" id="currentPassword">
                                                <button type="button" class="btn btn-toggle-password btn-toggle-pwd" tabindex="-1"
                                                    data-target="currentPassword" title="Tampilkan password">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group input-group-sm">
                                                <input name="newpassword" type="password" class="form-control form-control-sm" id="newPassword">
                                                <button type="button" class="btn btn-toggle-password btn-toggle-pwd" tabindex="-1"
                                                    data-target="newPassword" title="Tampilkan password">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group input-group-sm">
                                                <input name="renewpassword" type="password" class="form-control form-control-sm"
                                                    id="renewPassword">
                                                <button type="button" class="btn btn-toggle-password btn-toggle-pwd" tabindex="-1"
                                                    data-target="renewPassword" title="Tampilkan password">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <!-- Pesan error jika tidak cocok -->
                                            <div class="password-mismatch" id="renewPasswordMismatch">
                                                <i class="bi bi-exclamation-circle"></i>
                                                Password tidak cocok dengan password baru
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" id="btn_update_password">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>
        // Toggle show/hide password
        // Handler ini otomatis berlaku untuk SEMUA input dengan class .btn-toggle-pwd
        // (currentPassword, newPassword, renewPassword, password_herp)
        $(document).on('click', '.btn-toggle-pwd', function () {
            var targetId = $(this).data('target');
            var $input = $('#' + targetId);
            var $icon = $(this).find('i');
            var isPwd = $input.attr('type') === 'password';

            $input.attr('type', isPwd ? 'text' : 'password');
            $icon.toggleClass('bi-eye', !isPwd).toggleClass('bi-eye-slash', isPwd);
            $(this).attr('title', isPwd ? 'Sembunyikan password' : 'Tampilkan password');
        });

        // ============================================
        // Validasi: Re-enter New Password harus sama dengan New Password
        // ============================================
        function checkRenewPasswordMatch() {
            var newPwd = $('#newPassword').val();
            var renewPwd = $('#renewPassword').val();
            var $msg = $('#renewPasswordMismatch');
            var $renew = $('#renewPassword');

            // Jika re-entry masih kosong → tidak perlu tampilkan error
            if (renewPwd.length === 0) {
                $msg.removeClass('show');
                $renew.removeClass('is-invalid');
                return true;
            }

            var match = newPwd === renewPwd;

            if (match) {
                $msg.removeClass('show');
                $renew.removeClass('is-invalid');
                $renew.addClass('is-valid');
            } else {
                $msg.addClass('show');
                $renew.addClass('is-invalid');
                $renew.removeClass('is-valid');
            }

            return match;
        }

        // Trigger saat mengetik di newPassword atau renewPassword
        $('#newPassword, #renewPassword').on('input', checkRenewPasswordMatch);

        // Validasi final saat klik tombol Change Password
        $('#btn_update_password').on('click', function (e) {
            if (!checkRenewPasswordMatch()) {
                e.preventDefault();
                e.stopImmediatePropagation();
                $('#renewPassword').focus();
                return false;
            }
        });
    </script>
<?= $this->endSection() ?>