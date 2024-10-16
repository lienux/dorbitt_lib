<!-- <div class="modal fade" id="modal_delete_confirm" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centeredz">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title text-light" id="message_title">Confirmation</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete seletced items ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" type="button" class="btn btn-primary" id="modal_btn_delete">Delete</a>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="modal_delete_confirm" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-info py-2 text-light">
                <h6 class="modal-title"><i class="fas fa-exclamation-circle"></i> Confirmation</h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                        <i class="fa-light fa-rectangle-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-trash-alt fa-3x text-danger"></i>
                    </div>
                    <div class="col">
                        <h5>Are you sure you want to delete seletced items ?</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal_btn_delete">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_release_confirm" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-info py-2 text-light">
                <h6 class="modal-title"><i class="fas fa-exclamation-circle"></i> Confirmation</h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                        <i class="fa-light fa-rectangle-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-2">
                        <i class="far fa-check-circle fa-3x text-success"></i>
                    </div>
                    <div class="col-10">
                        <h5>Are you sure you want to release seletced items ?</h5>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal_btn_release">Release</button>
            </div>
        </div>
    </div>
</div>