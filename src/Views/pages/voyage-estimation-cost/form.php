<div class="mt-2">
    <div class="alert text-light collapse" id="alert_input"></div>
    <div class="collapse" id="loader_input">
        <div class="d-flex justify-content-center mt-2">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- SB Button -->
    <?=$this->include(config('Ummu')->Views('partials/sb_button'))?>

    <!-- Form -->
    <div id="form_input"> 
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row mb-2">
                            <label class="col-sm-4 col-form-label mb-0 pb-0" for="voyage_route">
                                Route<span class="text-danger small"> *</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control is-data-id" id="voyage_route" data-toggle="tooltip" data-placement="top" title="Voyage Route" required disabled>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary show-left-modal endis btn-endis" id="btn_show_voyageRoute" type="button" disabled
                                            data-inputid="voyage_route" data-modaltitle="Master Data - Voyage Route">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-1">Constants & Rates (Fixed Cost)</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Exchange Rate</label>
                                <div class="input-group input-group-sm mb-2">
                                    <input type="number" class="form-control" value="16500">
                                    <div class="input-group-append"><span class="input-group-text">IDR/USD</span></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Bunker Price</label>
                                <div class="input-group input-group-sm mb-2">
                                    <input type="number" class="form-control" value="15000">
                                    <div class="input-group-append"><span class="input-group-text">IDR/Ltr</span></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>TFC (Daily)</label>
                                <div class="input-group input-group-sm mb-2">
                                    <input type="number" class="form-control" value="1300">
                                    <div class="input-group-append"><span class="input-group-text">USD/Day</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white py-1">Vessel Particular & Speed (Variable)</div>
                    <div class="card-body p-0">
                        <table class="table table-sm mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th>Description</th>
                                    <th>Value</th>
                                    <th>Unit</th>
                                    <th>Consumption</th>
                                    <th>Unit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cargo Capacity</td>
                                    <td><input type="number" class="form-control form-control-sm" value="3500"></td>
                                    <td>Tons</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Laden Speed</td>
                                    <td><input type="number" class="form-control form-control-sm" value="3.5"></td>
                                    <td>Knots</td>
                                    <td><input type="number" class="form-control form-control-sm" value="100"></td>
                                    <td>Ltr/Hr</td>
                                </tr>
                                <tr>
                                    <td>Idle/Port Cons.</td>
                                    <td colspan="2">-</td>
                                    <td><input type="number" class="form-control form-control-sm" value="25"></td>
                                    <td>Ltr/Hr</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white py-1">Port Costs Breakdown</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <h6>Port of Loading (POL)</h6>
                                <input type="text" class="form-control form-control-sm mb-2" placeholder="Agency Cost" value="30,000,000">
                                <textarea class="form-control" rows="2" placeholder="Details (Akomodasi, Crane, dll)"></textarea>
                            </div>
                            <div class="col-md-6">
                                <h6>Port of Discharge (POD)</h6>
                                <input type="text" class="form-control form-control-sm mb-2" placeholder="Agency Cost" value="30,000,000">
                                <textarea class="form-control" rows="2" placeholder="Other Costs"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow border-danger mb-4">
                    <div class="card-header header-custom">Financial Summary</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Revenue
                            <span class="badge badge-success badge-pill">Rp 903,000,000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Bunker Costs
                            <span class="text-danger">Rp 420,600,000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Port & Agency Costs
                            <span class="text-danger">Rp 80,000,000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                            <strong>Operational Profit (TCE)</strong>
                            <strong>Rp 20,693,967 /day</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Daily Fixed Cost (TFC)
                            <span class="text-muted">Rp 21,450,000 /day</span>
                        </li>
                    </ul>
                    <div class="card-footer bg-margin-loss text-center">
                        <h4 class="mb-0">Margin: -3.65%</h4>
                        <small>Loss: -45.82 USD / Day</small>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">Time Summary</div>
                    <div class="card-body py-2">
                        <p class="mb-1">Total Time: <strong>18.23 Days</strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">Sailing</div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">Port</div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-block btn-lg mt-4 shadow">Recalculate Voyage</button>
            </div>
        </div>
    </div>
</div>
