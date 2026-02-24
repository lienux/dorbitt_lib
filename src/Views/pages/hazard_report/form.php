<div id="entry_data">
    <form id="form_entry_data">
        <div class="row">
            <div class="col-md-6 col-sm-12 text-sm">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="date" class="text-info">Tanggal penemuan *</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control cnclear" id="date" name="date" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary dis-able" type="button" id="btn_show_date"
                                    disabled><i class="fa-solid fa-calendar-days"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="time" class="text-info">Waktu *</label>
                        <div class="input-group input-group-sm clockpicker">
                            <input type="text" class="form-control cnclear" id="time" name="time" disabled>
                            <div class="input-group-addon input-group-append">
                                <button class="btn btn-outline-secondary dis-able" type="button" id="btn_show_time"
                                    disabled><i class="fas fa-clock"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="location" class="text-info">Lokasi temuan *</label>
                    <select id="location" class="form-control form-control-sm">
                        <option selected disabled>Choose...</option>
                        <option>PERJALANAN DARI TEMPAT TINGGAL KE TEMPAT KERJA</option>
                        <option>TEMPAT KERJA</option>
                        <option>PERJALANAN DARI TEMPAT KERJA KE TEMPAT TINGGAL</option>
                        <option>TEMPAT DINAS</option>
                        <option>LAINNYA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="detail_location" class="text-info">Detail lokasi*</label>
                    <input type="text" class="form-control form-control-sm" id="detail_location">
                </div>
                <div class="form-group">
                    <label for="type" class="text-info">Jenis temuan *</label>
                    <select id="type" class="form-control form-control-sm">
                        <option selected disabled>Choose...</option>
                        <option>TINDAKAN TIDAK AMAN (TTA)</option>
                        <option>KONDISI TIDAK AMAN (KTA)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="hazard" class="text-info">Bahaya yang ditemui *</label>
                    <input type="text" class="form-control form-control-sm" id="hazard">
                </div>
                <div class="form-group">
                    <label for="reason" class="text-info">Penyebab bahaya yang ditemui *</label>
                    <input type="text" class="form-control form-control-sm" id="reason">
                </div>
            </div>

            <div class="col-md-6 col-sm-12 text-sm">
                <div class="form-group">
                    <label for="hazard_code" class="text-info">Kode bahaya *</label>
                    <select id="hazard_code" class="form-control form-control-sm">
                        <option selected disabled>Choose...</option>
                        <option>AA (SANGAT BERISIKO/ TINGGI SEKALI)</option>
                        <option>A (BAHAYA RISIKO TINGGI)</option>
                        <option>B (BAHAYA RISIKO SEDANG)</option>
                        <option>C (BAHAYA RISIKO RENDAH)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image" class="text-info">Foto temuan*</label>
                    <input type="file" class="form-control form-control-sm" id="image">
                    <!-- <input id="input-b1" name="input-b1" type="file" class="file" data-browse-on-zone-click="true"> -->
                    <!-- <section class="bg-diffrent">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-8z">
                                    <div class="file-upload-contain">
                                        <input id="multiplefileupload" type="file" accept=".jpg,.gif,.png" multiple />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section> -->
                </div>
                <div class="form-group">
                    <label for="detail_repair" class="text-info">Rincian tindakan perbaikan segera*</label>
                    <input type="text" class="form-control form-control-sm" id="detail_repair">
                </div>
                <div class="form-group">
                    <label for="image2" class="text-info">Foto perbaikan</label>
                    <input type="file" class="form-control form-control-sm" id="image2">
                </div>
                <div class="form-group">
                    <label for="image2" class="text-info">Status*</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                value="option1">
                            <label class="form-check-label" for="inlineRadio1">Open</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                value="option2">
                            <label class="form-check-label" for="inlineRadio2">Close</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>