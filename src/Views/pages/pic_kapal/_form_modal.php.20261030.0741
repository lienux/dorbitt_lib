<div class="pic-kapal-modal" id="modalPIC">
  <div class="pk-dialog" role="dialog" aria-modal="true">
    <div class="pk-header">
      <h3 id="modalTitle">Tambah / Edit PIC Kapal</h3>
      <button type="button" class="pk-close" aria-label="Tutup">&times;</button>
    </div>

    <form id="formPic" onsubmit="return false;">
      <div class="pk-body">
        <input type="hidden" id="accountId">
        <input type="hidden" id="scopeType" value="BY_VESSEL">

        <div class="form-group" id="accountSelectWrap">
          <label>Pilih Akun (belum jadi PIC)</label>
          <select id="accountSelect">
            <option value="">-- Pilih Akun --</option>
          </select>
        </div>

        <div class="form-group" id="accountInfoWrap" style="display:none;">
          <label>Akun PIC</label>
          <div id="accountInfo" style="padding:10px 12px;background:#f8fafc;border-radius:6px;font-size:13px;"></div>
        </div>

        <div class="form-group">
          <label>Tipe Scope Akses Kapal</label>
          <div class="scope-options">
            <div class="scope-option selected" data-scope="BY_VESSEL">
              <h4>🚢 By Vessel</h4>
              <p>PIC hanya melihat kapal yang di-assign</p>
            </div>
            <div class="scope-option" data-scope="ALL_VESSELS">
              <h4>🌐 All Vessels</h4>
              <p>PIC melihat semua kapal (super access)</p>
            </div>
          </div>
        </div>

        <div class="form-group" id="vesselSection">
          <label>Assign Kapal (bisa pilih lebih dari satu)</label>
          <div class="vessel-checklist" id="vesselChecklist"></div>
        </div>

        <div class="form-group" id="allVesselNote" style="display:none;">
          <div class="info-box">
            ✅ PIC ini akan <strong>otomatis melihat semua kapal</strong> tanpa perlu di-assign satu per satu.
          </div>
        </div>
      </div>

      <div class="pk-footer">
        <button type="button" class="btn btn-secondary pk-close">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
      </div>
    </form>
  </div>
</div>