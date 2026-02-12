<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-4">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered text-sm text-nowrap table-hover" id="tbDailyProdCoalgettingPerLoc"
                width="100%" cellspacing="0">
                <thead class="bg-success text-light">
                    <tr>
                        <th class="text-center">Code</th>
                        <th class="text-center">Loc Name</th>
                        <th class="text-center">Ritase</th>
                        <th class="text-center">Tonase</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-8">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered text-sm text-nowrap table-hover dataTable" id="tbDailyProdCoalgettingPerTgl"
                width="100%" cellspacing="0">
                <thead class="bg-warning">
                    <tr>
                        <th rowspan="2" class="text-center">Date</th>
                        <th colspan="3" class="text-center">Ritase</th>
                        <th colspan="3" class="text-center">Tonase</th>
                        <th rowspan="2" class="text-center">Plan All Location</th>
                        <th rowspan="2" class="text-center">Arch (%)</th>
                        <th colspan="2" class="text-center">Fuel</th>
                    </tr>
                    <tr>
                        <th class="text-center">Day</th>
                        <th class="text-center">Night</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Day</th>
                        <th class="text-center">Night</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Consumtion</th>
                        <th class="text-center">Ratio</th>
                    </tr>
                </thead>
                <tbody id="hauler"></tbody>
                <tbody id="loader"></tbody>
            </table>
        </div>
    </div>
</div>