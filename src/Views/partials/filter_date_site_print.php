<div class="col-6 mb-3 px-0">
    <div class="col row">
        <div class="col-lg-4 col-md-4 col-sm-12 pl-0 mb-1">
            <label class="text-info text-sm m-0">Date <span class="text-danger">*</span></label>
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text">From</span>
                </div>
                <input type="text" class="form-control ummu-datepicker ummu-datepicker-default-from" id="iDateFrom" disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-show-datepicker" type="button"
                        data-inputid="iDateFrom"><i class="fas fa-calendar-alt"></i></button>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 mb-1 pl-0">
            <label class="text-info text-sm m-0">Project Area <span class="text-danger">*</span></label>
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" id="ummu_site_project_input" disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary ummubtn-showmodal-listdata rounded-right" type="button"
                        id="btn_show_list_site_project">Choose</button>
                </div>
                <div class="input-group-append ml-2">
                    <button class="btn btn-primary rounded" type="button"
                        id="btn_get_data"><i class="fas fa-file-search"></i> Retrieve</button>
                </div>
                <div class="input-group-append ml-2">
                    <button class="btn btn-primary rounded" type="button"
                        id="btn_print_to_pdf"><i class="fas fa-file-pdf"></i> PDF</button>
                </div>
            </div>
        </div>
    </div>
</div>