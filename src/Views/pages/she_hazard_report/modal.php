<div class="modal fade" id="modal_agreement" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-info py-2 text-light">
                <h6 class="modal-title"><i class="fal fa-file-contract"></i> Agreement Hazard Report</h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light btn-max" id="btn_max"
                        data-modalid="modal_agreement"><i class="fa-regular fa-arrows-maximize"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal"><i
                            class="fa-light fa-rectangle-xmark"></i></button>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-rectangle-xmark"></i></button> -->
                </div>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12"
                    style="font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400;">
                    <h5 class="card-title">HILLCON HAZARD REPORT</h5>
                    <p class="text-justify">Hillcon Hazard Report atau dikenal juga sebagai Pelaporan Bahaya merupakan
                        “wadah/media” bagi pekerja untuk melaporkan bahaya di tempat kerja yang berpotensi menyebabkan
                        kerugian/kecelakaan (cidera, penyakit, kerusakan maupun pencemaran) yang digunakan oleh
                        karyawan/ti PT Hillconjaya Sakti sebagai bagaian dari implementasi SHAKTI Manajemen Sistem.
                        Hazard Report digunakan oleh karyawan untuk melaporkan semua bahaya baik berupa kondisi tidak
                        aman (KTA) maupun tindakan tidak aman (TTA) yang ditemukan.
                        Formulir hazard report ini merupakan bentuk digital dari formulir No. HJS.SHE.F-009 ; Rev.00.
                    </p>

                    <p class="text-justify">
                        <span class="text-info mb-0">Ketentuan :</span><br>
                        - Formulir ini diisi oleh semua karyawan yang menemukan potensi bahaya tidak terbatas pada area
                        kerjanya saja<br>
                        - Diisi sesuai dengan kondisi/tindakan aktual yang ditemui<br>
                        - Periode pengisian adalah setiap bulan sesuai dengan target yang ditetapkan<br>
                        - Batas paling akhir pengisian formulir hazard report adalah 1 hari setelah bulan berakhir <br>
                        - Hasil rekaman hazard report akan dievaluasi, direkap dan dianalisa oleh SHE Departemen<br>
                        - Jumlah hazard report yang telah dibuat akan digunakan sebagai komponen insentif kehadiran<br>
                        - Kejadian/kondisi bahaya yang dilaporkan harus terjadi pada bulan yang ingin dilaporkan. Jika
                        kejadian/kondisi bahaya yang dilaporkan terjadi di luar bulan tersebut, maka pelaporan Hazard
                        Report tidak terhitung. Contoh : Pelaporan untuk bulan Januari harus kejadian/kondisi bahaya di
                        bulan Januari. Apabila di luar bulan tersebut, maka hazard report tidak terhitung untuk bulan
                        Januari.
                    </p>

                    <p class="text-justify">Demikian, semoga bermanfaat untuk kita semua, atas perhatian dan
                        kerjasamanya kami ucapkan terimakasih.</p>

                    <p>Salam HILLCON !</p>

                    <p>
                        <span class="text-info mb-0">More Information :</span><br>
                        <a href="mailto:ho.she.spv@hillconmining.com">ho.she.spv@hillconmining.com</a> (Fauzi
                        Albantani)<br>
                        <a href="mailto:ho.she.sectionhead@hillconmining.com">ho.she.sectionhead@hillconmining.com</a>
                        (Linggar Ismara)
                    </p>

                    <h5 class="pt-4">Alur Proses Pelaporan Bahaya (Hazard Report)</h5>
                    <img src="<?= base_url('uploads/AlurProsesPelaporanBahaya.png') ?>" class="img-fluid"
                        style="width: 60%;">
                    <div class="form-group form-check pt-3">
                        <input type="checkbox" class="form-check-input" id="persetujuan">
                        <label class="form-check-label text-justify" for="persetujuan">Saya telah membaca dan menyetujui
                            ketentuan pengisian hazard report yang telah ditetapkan</label>
                    </div>
                    <!-- <button type="button" class="btn btn-sm btn-outline-primary" id="lanjutkan" disabled>Lanjutkan</button> -->
                </div>
            </div>
            <div class="modal-footer py-1">
                <div class="text-danger" id="modal_response_message"></div>
                <div class="collapse" id="modal_loader_approval">
                    <div class="d-flex justify-content-center mt-2">
                        <div class="spinner-border text-danger" role="status">
                            <!-- <span class="visually-hidden">Loading...</span> -->
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-primary" id="lanjutkan" data-bs-dismiss="modal"
                    disabled>Lanjutkan <i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-info py-2 text-light">
                <h6 class="modal-title"><i class="fal fa-file-contract"></i> Form Hazard Report</h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light btn-max" id="btn_max"><i
                            class="fa-regular fa-arrows-maximize"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal"><i
                            class="fa-light fa-rectangle-xmark"></i></button>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-rectangle-xmark"></i></button> -->
                </div>
            </div>
            <div class="modal-body">
                <!-- <div class="alert text-light collapse" id="modal_alert_approval"></div> -->
                <div id="entry_data">
                    <form id="form_entry_data">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 text-sm">
                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="doc_number" class="text-info mb-0">NOMOR DOKUMEN <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm valcl" id="doc_number"
                                            name="doc_number" readonly disabled>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="status" class="text-muted mb-0">Approval Status : </label><br>
                                        <label class="form-control form-control-sm htmlcl border-0" id="status"
                                            style="background-color: #e9e9e9;"></label>
                                        <!-- <input type="text" class="form-control form-control-sm valcl" id="status"
                                            name="status" readonly disabled> -->

                                        <!-- <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="status"
                                                name="tgl_penemuan" disabled>
                                        </div> -->
                                    </div>

                                    <!-- <div class="form-group col-sm-12 col-md-6">
                                        <label for="tgl_penemuan" class="text-info mb-0">Tanggal penemuan <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control valcl" id="tgl_penemuan"
                                                name="tgl_penemuan" readonly disabled>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary dis-able" type="button"
                                                    id="btn_show_date"><i
                                                        class="fa-solid fa-calendar-days"></i></button>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="tgl_penemuan" class="text-info mb-0">TANGGAL PENEMUAN <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control valcl" id="tgl_penemuan"
                                                name="tgl_penemuan" readonly disabled>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary dis-able endis" type="button"
                                                    id="btn_show_datepicker" data-inputid="tgl_penemuan"><i
                                                        class="fa-solid fa-calendar-days"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="waktu_penemuan" class="text-info mb-0">Waktu <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm clockpicker">
                                            <input type="text" class="form-control valcl" id="waktu_penemuan"
                                                name="waktu_penemuan" readonly disabled>
                                            <div class="input-group-addon input-group-append">
                                                <button class="btn btn-outline-secondary dis-able endis" type="button"
                                                    id="btn_show_timez"><i class="fas fa-clock"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi_penemuan" class="text-info mb-0">LOKASI TEMUAN <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select id="lokasi_penemuan"
                                            class="form-control form-control-sm select2cl endis endis-edit">
                                            <option selected disabled>Choose...</option>
                                            <option value="1">PERJALANAN DARI TEMPAT TINGGAL KE TEMPAT KERJA</option>
                                            <option value="2">TEMPAT KERJA</option>
                                            <option value="3">PERJALANAN DARI TEMPAT KERJA KE TEMPAT TINGGAL</option>
                                            <option value="4">TEMPAT DINAS</option>
                                            <option value="5">LAINNYA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="detail_lokasi" class="text-info mb-0">DETAIL LOKASI <span
                                            class="text-danger">*</span></label>
                                    <!-- <input type="text" class="form-control form-control-sm valcl endis endis-edit"
                                        id="detail_lokasi"> -->
                                    <textarea class="form-control valcl endis endis-edit" id="detail_lokasi"
                                        rows="1"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_temuan" class="text-info mb-0">JENIS TEMUAN <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select id="jenis_temuan"
                                            class="form-control form-control-sm select2cl endis endis-edit">
                                            <option selected disabled>Choose...</option>
                                            <option value="1">TINDAKAN TIDAK AMAN (TTA)</option>
                                            <option value="2">KONDISI TIDAK AMAN (KTA)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bahaya_ditemukan" class="text-info mb-0">BAHAYA DAN RESIKO YANG DITEMUI
                                        <span class="text-danger">*</span></label>
                                    <!-- <input type="text" class="form-control form-control-sm valcl endis endis-edit"
                                        id="bahaya_ditemukan"> -->
                                    <textarea class="form-control valcl endis endis-edit" id="bahaya_ditemukan"
                                        rows="1"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="penyebab_bahaya" class="text-info mb-0">PENYEBAB BAHAYA YANG DITEMUI
                                        <span class="text-danger">*</span></label>
                                    <!-- <input type="text" class="form-control form-control-sm valcl endis endis-edit"
                                        id="penyebab_bahaya"> -->
                                    <textarea class="form-control valcl endis endis-edit" id="penyebab_bahaya"
                                        rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kode_bahaya" class="text-info mb-0">KODE BAHAYA <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select id="kode_bahaya"
                                            class="form-control form-control-sm select2cl endis endis-edit">
                                            <option selected disabled>Choose...</option>
                                            <option value="1">AA (SANGAT BERISIKO/ TINGGI SEKALI)</option>
                                            <option value="2">A (BAHAYA RISIKO TINGGI)</option>
                                            <option value="3">B (BAHAYA RISIKO SEDANG)</option>
                                            <option value="4">C (BAHAYA RISIKO RENDAH)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rincian_tindakan" class="text-info mb-0">RINCIAN TINDAKAN PERBAIKAN
                                        SEGERA YANG ANDA LAKUKAN <span class="text-danger">*</span></label>
                                    <!-- <input type="text" class="form-control form-control-sm valcl endis endis-edit"
                                        id="rincian_tindakan"> -->
                                    <textarea class="form-control valcl endis endis-edit" id="rincian_tindakan"
                                        rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 text-sm">
                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="foto_temuan" class="text-info">FOTO TEMUAN</label><br>
                                            <img src="<?= base_url('uploads/no_image.jpg') ?>"
                                                class="img-thumbnail img-show-mygallery imgcl" alt="..." width="100%"
                                                id="img_foto_temuan" data-inputid="foto_temuan"
                                                data-imageid="img_foto_temuan">
                                            <label for="" class="text-xs text-danger lbl-info">Klik bingkai untuk
                                                memilih
                                                foto</label>
                                            <div class="input-group input-group-sm mb-3 collapse">
                                                <input type="text" class="form-control" id="foto_temuan" readonly
                                                    disabled>
                                                <div class="input-group-append">
                                                    <button
                                                        class="btn btn-outline-secondary btn_show_gallery btn-show-mygallery"
                                                        type="button" id="btn_image" data-inputid="foto_temuan"
                                                        data-imageid="img_foto_temuan">Choose File</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="foto_perbaikan" class="text-info">FOTO PERBAIKAN</label><br>
                                            <img src="<?= base_url('uploads/no_image.jpg') ?>"
                                                class="img-thumbnail img-show-mygallery imgcl" alt="..." width="100%"
                                                id="img_foto_perbaikan" data-inputid="foto_perbaikan"
                                                data-imageid="img_foto_perbaikan">
                                            <label for="" class="text-xs text-danger lbl-info">Klik bingkai untuk
                                                memilih
                                                foto</label>
                                            <div class="input-group input-group-sm mb-3 collapse">
                                                <input type="text" class="form-control" id="foto_perbaikan" readonly
                                                    disabled>
                                                <div class="input-group-append">
                                                    <button
                                                        class="btn btn-outline-secondary btn_show_gallery btn-show-mygallery"
                                                        type="button" id="btn_image2" data-inputid="foto_perbaikan"
                                                        data-imageid="img_foto_perbaikan">Choose
                                                        File</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-info mb-0">STATUS <span class="text-danger">*</span></label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input status radiocl endis" type="radio"
                                                name="status" id="open" value="0">
                                            <label class="form-check-label" for="open">Open</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input status radiocl endis" type="radio"
                                                name="status" id="close" value="1">
                                            <label class="form-check-label" for="close">Close</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-info mb-0">NAMA ATASAN/ SPV/ SECTION HEAD <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm valcl endis" id="nm_atasan">
                                </div>

                                <div class="form-group collapse" id="div_remark">
                                    <label class="text-muted mb-0">Remark</label>
                                    <textarea class="form-control border-0 valcl" id="remark" rows="2"
                                        disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>

                <div class="text-sm" id="footer_trx">
                    <div class="row">
                        <div class="col"><span class="text-xs text-muted">Created By:</span> <span
                                class="badge badge-secondary htmlcl" id="created_by"></span>
                        </div>
                        <div class="col"><span class="text-xs text-muted">Updated By:</span> <span
                                class="badge badge-secondary htmlcl" id="updated_by"></span>
                        </div>
                        <div class="col"><span class="text-xs text-muted">Approved By:</span> <span
                                class="badge badge-secondary htmlcl" id="approved_by"></span>
                        </div>
                        <div class="col"><span class="text-xs text-muted">Rejected By:</span> <span
                                class="badge badge-secondary htmlcl" id="rejected_by"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><span class="text-xs text-muted">Created At:</span> <span
                                class="badge badge-secondary htmlcl" id="created_at"></span>
                        </div>
                        <div class="col"><span class="text-xs text-muted">Updated At:</span> <span
                                class="badge badge-secondary htmlcl" id="updated_at"></span>
                        </div>
                        <div class="col"><span class="text-xs text-muted">Approved At:</span> <span
                                class="badge badge-secondary htmlcl" id="approved_at"></span>
                        </div>
                        <div class="col"><span class="text-xs text-muted">Rejected At:</span> <span
                                class="badge badge-secondary htmlcl" id="rejected_at"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-1"></div>
        </div>
    </div>
</div>