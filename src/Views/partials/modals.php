<!-- Full Screen Modal -->
<div class="modal fade" id="modal_dismod" tabindex="-1" zdata-bs-backdrop="false" data-bs-backdrop="static" data-bs-keyboard="false">
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

        data-cookie="true"
        data-cookie-id-table="tbDismodModule"

        data-detail-view="true"
        data-detail-formatter="$ummu.bt.detailFormatter"

        data-id-field="id"
        zdata-click-to-select="true"
        data-checkbox-header="true"
        data-minimum-count-columns="2"

        data-buttons="app.views.button"
        zdata-buttons-class="primary"

        data-filter-control="true"
        data-pagination="true"
        data-page-list="[10, 25, 50, 100]"
        data-side-pagination="server"

        data-response-handler="$ummu.bt.responseHandler" class="text-nowrap table-sm">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true" ></th>
                <th data-sortable="true" data-field="id" data-formatter="$ummu.formatter.btID">ID</th>
                <th data-sortable="true" data-field="name" data-filter-control="input">Name</th>
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