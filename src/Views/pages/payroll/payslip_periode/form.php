<div class="modal fade" id="form_input_modal" tabindex="-2" style="z-index: 3000;">
    <div class="modal-dialog modal-dialog-centeredz">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-2">
                <h5 class="modal-title text-light" id="message_title">Form Payslip Periode</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert text-light collapse" id="alert_form_modal"></div>
            <div class="collapse" id="loader_form_modal">
                <div class="d-flex justify-content-center mt-2">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div id="form_periode">
                    <form enctype="multipart/form-data" id="form_import_file">
                        <div class="col-md-12">
                            <label class="form-label">Periode Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" id="name">
                            <label class="small text-danger collapse" id="name_msg_required">Periode name wajib diisi</label>
                        </div>                    
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" type="button" class="btn btn-primary" id="btn_save">Submit</a>
            </div>
        </div>
    </div>
</div>