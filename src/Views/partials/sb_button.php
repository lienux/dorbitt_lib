<div class="mb-2" id="classic_button">
    <div class="sb-toolbar">
        <button class="btn btn-sm btn-primary" type="button" id="btn_new">
            <i class="bi bi-plus-circle-fill"></i> New
        </button>
        <button class="btn btn-sm" type="button" id="btn_edit" disabled>
            <i class="bi bi-pencil-square"></i> Edit
        </button>
        <button class="btn btn-sm" type="button" id="btn_delete" disabled>
            <i class="bi bi-trash-fill"></i> Delete
        </button>
        <button class="btn btn-sm" type="button" id="btn_cancle" disabled>
            <i class="bi bi-x-circle-fill"></i> Cancle
        </button>
        <button class="btn btn-sm" type="button" id="btn_save" disabled>
            <i class="bi bi-floppy-fill"></i> Save
        </button>
        <!-- <button class="btn btn-sm btn-secondary" type="button" id="btn_close" disabled>
            <i class="bi bi-box-arrow-right"></i> Close
        </button> -->

        <div class="modal fade" id="modalDeleteConfirm" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog" id="modal_dialog">
                <div class="modal-content bg-light">
                    <div class="modal-header bg-purple py-2 text-light">
                        <h6 class="modal-title text-light"><i class="fas fa-exclamation-circle"></i> Confirmation</h6>
                        <div class="">
                            <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                                <i class="fa-light fa-rectangle-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-2 mr-0 pr-0">
                                <i class="fas fa-trash-alt fa-3x text-danger"></i>
                            </div>
                            <div class="col ml-0 pl-0">
                                <h5>Are you sure you want to delete seletced items?</h5>
                                <h5 id="message_data"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-in-modal" id="sb_modal_btn_delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalSuccessMessage" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog" id="modal_dialog">
                <div class="modal-content bg-light">
                    <div class="modal-header bg-purple py-2 text-light">
                        <h6 class="modal-title"><i class="fas fa-check-circle"></i> Success Messages</h6>
                        <div class="">
                            <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                                <i class="fa-light fa-rectangle-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success text-sm" id="alert"></div>
                    </div>
                    <div class="modal-footer py-1">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
