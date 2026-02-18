<!-- Full Screen Modal -->
<div class="modal fade" id="modal_dismod" tabindex="-1" zdata-bs-backdrop="false" data-bs-backdrop="static" data-bs-keyboard="false" data-tableid="tbDismodModule">
    <div class="modal-dialog ummu-modal-rightschreen">
    <div class="modal-content">
      <div class="modal-header bg-purple">
        <h5 class="modal-title text-light">Modules</h5>
        <button type="button" class="btn-close ummu-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table
        id="tbDismodModule"
        data-ajax="app.controllers.show_dismod"
        data-toolbar="#toolbar"
        data-search="true"
        data-search-highlight="true"

        data-show-refresh="true"
        data-show-toggle="true"
        data-show-fullscreen="true"
        data-show-columns="true"
        data-show-columns-toggle-all="true"
        data-show-export="true"
        data-show-search-clear-button="true"
        zdata-show-pagination-switch="true"
        data-multiple-select-row="true"

        data-cookie="true"
        data-cookie-id-table="tbDismodModule"

        data-detail-view="true"
        data-detail-formatter="$ummu.bt.detailFormatter"

        data-id-field="id"
        zdata-click-to-select="true"
        data-checkbox-header="true"
        data-minimum-count-columns="2"

        data-buttons="app.views.table3_butoon"
        zdata-buttons-class="primary"

        data-filter-control="true"
        data-pagination="true"
        data-page-list="[10, 25, 50, 100, all]"
        zdata-side-pagination="server"

        data-response-handler="$ummu.bt.responseHandler" class="text-nowrap table-sm">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true" ></th>
                <th data-sortable="true" data-field="module_id" class="text-center">Module ID</th>
                <th data-sortable="true" data-field="kode" zdata-filter-control="input">Kode</th>
                <th data-sortable="true" data-field="name" zdata-filter-control="input">Name</th>
                <th data-field="path" >Path</th>
            </tr>
        </thead>
        </table>
      </div>
      <div class="modal-footer justify-content-start">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
    </div>
</div><!-- End Full Screen Modal-->

<div class="modal fade" id="ummu_modal_message" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog" id="modal_dialog">
        <div class="modal-content">
            <div class="modal-header bg-purple py-2 text-light">
                <h6 class="modal-title text-light"><i class="fas fa-exclamation-circle"></i> Messages</h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                        <i class="fa-light fa-rectangle-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning text-sm" id="alert"></div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-right" id="modal_listData" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-purple py-2 text-light rounded-0">
                <h6 class="modal-title"><i class="fas fa-database"></i> <span>List Data</span></h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">
                        <i class="fa-light fa-rectangle-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered text-sm text-nowrap" id="$modalLeft_table_ListData" width="100%"
                        cellspacing="0">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>