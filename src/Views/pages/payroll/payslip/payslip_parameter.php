<div class="invoice-header row">
    <div class="col-6">
        <div class="row">
            <div class="col-4 px-0">NIK</div>
            <div>:</div>
            <div class="col" id="nik"></div>
        </div>
        <div class="row">
            <div class="col-4 px-0">Nama</div>
            <div>:</div>
            <div class="col" id="name"></div>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-4 px-0">Lokasi Tugas</div>
            <div>:</div>
            <div class="col" id="site"></div>
        </div>
        <div class="row">
            <div class="col-4 px-0">Jabatan</div>
            <div>:</div>
            <div class="col" id="jabatan"></div>
        </div>
    </div>
    <div class="col-12 text-center pt-2">
        <h5 class="font-weight-bold m-0" id="periode_name"></h5>
    </div>
</div>
<div class="invoice-content mb-0">
    <div class="table-responsive mb-0">
        <table class="table table-invoice mb-0">
            <tbody>
                <!-- Gapok -->
                <tr>
                    <td class="Description">
                        <div class="text-inverse" style="font-weight: bold;">Gaji Pokok</div>
                        <div id="rapel_gaji_name"></div>
                        <div id="lain_lain_name"></div>

                        <div id="rapel_gaji_name2"></div>
                        <div id="lain_lain_name2"></div>
                    </td>
                    <td class="text-center Rp"></td>
                    <td class="text-right Nilai"></td>
                    <td class="text-right Nilai"></td>
                    <td class="text-center Rp">
                        <div>Rp.</div>
                        <div id="rapel_gaji_rp"></div>
                        <div id="lain_lain_rp"></div>

                        <div id="rapel_gaji_rp2"></div>
                        <div id="lain_lain_rp2"></div>
                    </td>
                    <td class="text-right Nilai">
                        <div class="font-weight-bold" id="gapok_value"></div>
                        <div id="rapel_gaji_value"></div>
                        <div id="lain_lain_value"></div>

                        <div id="rapel_gaji_value2"></div>
                        <div id="lain_lain_value2"></div>
                    </td>
                </tr>
                
                <!-- Tunjangan -->
                <tr>
                    <td class="Description">
                        <span class="text-inverse" style="font-weight: bold;">Tunjangan</span><br>
                        <div id="insentif_produksi_name"></div>
                        <div id="insentif_kehadiran_name"></div>
                        <div id="tj_kesetaraan_name"></div>
                        <div id="tj_acting_name"></div>

                        <div id="insentif_produksi_name2"></div>
                        <div id="insentif_kehadiran_name2"></div>
                        <div id="tj_kesetaraan_name2"></div>
                        <div id="tj_acting_name2"></div>
                    </td>
                    <td class="text-center">
                        <br>
                        <div id="insentif_produksi_rp"></div>
                        <div id="insentif_kehadiran_rp"></div>
                        <div id="tj_kesetaraan_rp"></div>
                        <div id="tj_acting_rp"></div>

                        <div id="insentif_produksi_rp2"></div>
                        <div id="insentif_kehadiran_rp2"></div>
                        <div id="tj_kesetaraan_rp2"></div>
                        <div id="tj_acting_rp2"></div>
                    </td>
                    <td class="text-right">
                        <br>
                        <div id="insentif_produksi_value"></div>
                        <div id="insentif_kehadiran_value"></div>
                        <div id="tj_kesetaraan_value"></div>
                        <div id="tj_acting_value"></div>

                        <div id="insentif_produksi_value2"></div>
                        <div id="insentif_kehadiran_value2"></div>
                        <div id="tj_kesetaraan_value2"></div>
                        <div id="tj_acting_value2"></div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                
                <!-- total tunjangan -->
                <tr>
                    <td></td>
                    <td colspan="3" class="text-right">
                        <div class="font-weight-bold text-left">Total Tunjangan</div>
                        <div class="font-weight-bold">Gaji Bruto</div>
                    </td>
                    <td class="text-center">
                        <span>Rp.</span><br>
                        <span>Rp.</span>
                    </td>
                    <td class="text-right">
                        <div id="total_tunjangan_value"></div>
                        <div id="gaji_bruto_value"></div>
                    </td>
                </tr>
                
                <!-- Potongan -->
                <tr>
                    <td>
                        <div class="text-inverse" style="font-weight: bold;">Potongan</div>
                        <div id="potongan_jamsostek_jht_name"></div>
                        <div id="potongan_jamsostek_jp_name"></div>
                        <div id="potongan_kasbon_name"></div>
                        <div id="potongan_tiket_name"></div>

                        <div id="potongan_jamsostek_jht_name2"></div>
                        <div id="potongan_jamsostek_jp_name2"></div>
                        <div id="potongan_kasbon_name2"></div>
                        <div id="potongan_tiket_name2"></div>
                    </td>
                    <td class="text-center">
                        <br>
                        <div id="potongan_jamsostek_jht_rp"></div>
                        <div id="potongan_jamsostek_jp_rp"></div>
                        <div id="potongan_kasbon_rp"></div>
                        <div id="potongan_tiket_rp"></div>

                        <div id="potongan_jamsostek_jht_rp2"></div>
                        <div id="potongan_jamsostek_jp_rp2"></div>
                        <div id="potongan_kasbon_rp2"></div>
                        <div id="potongan_tiket_rp2"></div>
                    </td>
                    <td class="text-right">
                    <br>
                        <div id="potongan_jamsostek_jht_value"></div>
                        <div id="potongan_jamsostek_jp_value"></div>
                        <div id="potongan_kasbon_value"></div>
                        <div id="potongan_tiket_value"></div>

                        <div id="potongan_jamsostek_jht_value2"></div>
                        <div id="potongan_jamsostek_jp_value2"></div>
                        <div id="potongan_kasbon_value2"></div>
                        <div id="potongan_tiket_value2"></div>
                    </td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-right"></td>
                </tr>
                
                <!-- total potongan -->
                <tr>
                    <td>
                        <img src="" width="75px" id="qrcode">
                    </td>
                    <td colspan="3" class="text-right">
                        <div class="font-weight-bold text-left">Total Potongan</div>
                        <div class="font-weight-bold">Gaji Netto (THP)</div>
                        <div id="saldo_kasbon_name"></div>
                        <div id="saldo_kasbon_name2"></div>
                    </td>
                    <td class="text-center">
                        <div>Rp. </div>
                        <div>Rp. </div>
                        <div id="saldo_kasbon_rp"></div>
                        <div id="saldo_kasbon_rp2"></div>
                    </td>
                    <td class="text-right">
                        <div id="total_potongan_value"></div>
                        <div id="gaji_netto_value"></div>
                        <div id="saldo_kasbon_value"></div>
                        <div id="saldo_kasbon_value2"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>