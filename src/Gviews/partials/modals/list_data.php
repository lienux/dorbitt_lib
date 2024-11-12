<div class="modal fade" tabindex="-1" role="dialog" id="modal_list_data_stisla" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5> <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body"> Modal body text goes here.</div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_list_data" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-info py-2 text-light">
                <h6 class="modal-title"><i class="fas fa-exclamation-circle"></i> List Data</h6>
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