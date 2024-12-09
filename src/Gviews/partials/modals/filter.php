<div class="modal fade" id="modal_filter" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-secondary py-2 text-light">
                <h6 class="modal-title"><i class="fas fa-filter"></i> Fillter</h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                        <i class="fa-light fa-rectangle-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="date_from" class="text-info">From</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control datepicker000" id="date_from" name="date_from">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id=""><i class="fa-solid fa-calendar-days"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="date_to" class="text-info">To</label>
                        <div class="input-group input-group-sm clockpicker">
                            <input type="text" class="form-control datepicker000" id="date_to" name="date_to">
                            <div class="input-group-addon input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id=""><i class="fa-solid fa-calendar-days"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="btn_save_filter">Save Change</button>
            </div>
        </div>
    </div>
</div>