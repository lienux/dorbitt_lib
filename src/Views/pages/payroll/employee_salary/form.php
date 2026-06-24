<div class="modal fade" id="ApproveModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollablez modal-xl" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-info py-2 text-light">
                <h6 class="modal-title"><i class="fal fa-file-contract"></i> PO Document</h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" id="btn_max"><i class="fa-regular fa-arrows-maximize"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal"><i class="fa-light fa-rectangle-xmark"></i></button>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-rectangle-xmark"></i></button> -->
                </div>
            </div>
            <div class="modal-body">
                <div class="alert text-light collapse" id="modal_alert_approval"></div>
                <!-- <div class="collapse" id="modal_loader_approval">
                    <div class="d-flex justify-content-center mt-2">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div> -->
                <form id="form_approvall">

                    <div class="card mb-3 border-left-primary dorbitt-header">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Header</h5>
                            <div class="col-12 px-0 mb-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm text-sm text-nowrap my-0" cellspacing="0">
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <th class="text-center" style="width:275px;">Status<span class="text-danger"> *</span></th>
                                                <th class="text-center">Remark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="row m-0 p-0">
                                                        <div class="form-check mx-2">
                                                            <input class="form-check-input" id="rad_approve" type="radio" value="1" name="status_approve">
                                                            <label class="form-check-label" for="rad_approve">Approve</label>
                                                        </div>
                                                        <div class="form-check mx-2">
                                                            <input class="form-check-input" id="rad_pending" type="radio" value="3" name="status_approve">
                                                            <label class="form-check-label" for="rad_pending">Pending</label>
                                                        </div>
                                                        <div class="form-check mx-2">
                                                            <input class="form-check-input" id="rad_reject" type="radio" value="2" name="status_approve">
                                                            <label class="form-check-label" for="rad_reject">Reject</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <textarea type="text" class="form-control form-control-sm" id="new_remark" style="height: 30px;"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-12">
                                    <div class="row font-weight-bold" >
                                        <label class="col-12 text-primary" id="doc_number"></label>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Date</label>: <span class="col" id="doc_date"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Expired</label>: <span class="col text-sm" id="expired"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Priority</label>: <span class="col text-sm" id="priority"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">ETD</label>: <span class="col text-sm" id="etd"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Doc Remark</label>: <span class="col text-sm" id="remark"></span>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-12 pt-1">
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Project Area</label>: <span class="col text-sm" id="project_area"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Storage Loc</label>: <span class="col text-sm" id="storage_location"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Supplier</label>: <span class="col text-sm" id="supplier"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Tax1</label>: <span class="col text-sm" id="tax1"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Tax2</label>: <span class="col text-sm" id="tax2"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Tax3</label>: <span class="col text-sm" id="tax3"></span>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-12 pt-1">
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">PR No</label>: <span class="col text-sm" id="pr_num"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Term</label>: <span class="col text-sm" id="term"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Cost Center</label>: <span class="col text-sm" id="cost_center"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Currency</label>: <span class="col text-sm" id="currency"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Kurs</label>: <span class="col text-sm" id="kurs"></span>
                                    </div>
                                    <div class="row text-sm">
                                        <label class="col-4 text-info">Tax Kurs</label>: <span class="col text-sm" id="tax_kurs"></span>
                                    </div>
                                </div>
                            </div>
                        </div>                  
                    </div>

                    <div class="mb-1">
                        <button type="button" class="btn btn-outline-info btn-sm" id="btn_approved_list">Approved List</button>
                    </div>

                    <div class="card mb-3 border-left-danger dorbitt-detail">
                        <div class="card-body">
                            <h5 class="card-title text-danger">Details</h5>
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm text-sm text-nowrap" id="tbDetails" cellspacing="0">
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <th class="text-center" style="width:275px;">Status</th>
                                                <th class="">Comment</th>
                                                <th class="">Part Code</th>
                                                <th class="">Part Name</th>
                                                <th class="text-center">Qty Order <span class="text-danger">*</span></th>
                                                <th class="text-center">UoM</th>
                                                <th class="text-center">Price <span class="text-danger">*</span></th>
                                                <th class="text-center">Disc %</th>
                                                <th class="text-center">Sub Price</th>
                                                <th class="text-center">Tax</th>
                                                <th class="text-center">ETD</th>
                                                <th class="text-center">ETA</th>
                                                <th class="text-center">Warranty</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer mt-2" style="border-top: 0px;">
                            <div class="card-body pt-1 pb-1 dorbitt-doc-footer">
                                <div class="row ">
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="row text-sm">
                                            <label class="col-3 text-info">User</label>: <span class="col" id="user"></span>
                                        </div>
                                        <div class="row text-sm">
                                            <label class="col-3 text-info">Owner</label>: <span class="col" id="owner"></span>
                                        </div>
                                        <div class="row text-sm">
                                            <label class="col-3 text-info">Printed</label>: <span class="col" id="printed"></span>
                                        </div>
                                        <div class="row text-sm">
                                            <label class="col-3 text-info">Edited</label>: <span class="col" id="edited"></span>
                                        </div>
                                        <div class="row text-sm">
                                            <label class="col-3 text-info">Last Update</label>: <span class="col" id="last_update"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="row text-sm">
                                            <label class="col text-right text-info">Sub Total</label>: <span class="col-4 text-right" id="sub_total"></span>
                                        </div>
                                        <div class="row text-sm">
                                            <label class="col text-right text-info">Tax1</label>: <span class="col-4 text-right" id="foot_tax1"></span>
                                        </div>
                                        <div class="row text-sm">
                                            <label class="col text-right text-info">Tax2</label>: <span class="col-4 text-right" id="foot_tax2"></span>
                                        </div>
                                        <div class="row text-sm">
                                            <label class="col text-right text-info">Tax3</label>: <span class="col-4 text-right" id="foot_tax3"></span>
                                        </div>
                                        <div class="row text-sm">
                                            <label class="col text-right text-info">T O T A L</label>: <span class="col-4 text-right font-weight-bold" id="net"></span>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <div class="text-danger" id="modal_response_message"></div>
                <div class="collapse" id="modal_loader_approval">
                    <div class="d-flex justify-content-center mt-2">
                        <div class="spinner-border text-danger" role="status">
                            <!-- <span class="visually-hidden">Loading...</span> -->
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="btn_approve">Save Change</button>
            </div>
        </div>
    </div>
</div>