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
                    <label for="date_from" class="text-info">DateTime Start</label>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text rounded-0"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="text" class="form-control datepicker000" id="date_from" name="date_from">
                        <span class="input-group-text rounded-0"><i class="fas fa-clock"></i></span>
                        <input type="text" class="form-control clockpicker" id="time_from" name="time_from">
                    </div>

                    <label for="date_from" class="text-info">DateTime End</label>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text rounded-0"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="text" class="form-control datepicker000" id="date_to" name="date_to">
                        <span class="input-group-text rounded-0"><i class="fas fa-clock"></i></span>
                        <input type="text" class="form-control clockpicker" id="time_to" name="time_to">
                    </div>
                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-sm btn-primary" id="btn_save_filter">Save Filter</button>
            </div>
        </div>
    </div>
</div>