<style>
	/* Mengatur ukuran font keseluruhan tabel */
	#v_dataTable {
	    font-size: 14px !important; /* Sesuaikan ukuran (misal: 12px, 13px, atau 14px) */
	}

	/* Mengatur font pada Header (Judul Kolom) */
	#v_dataTable thead th {
	    font-size: 14px !important;
	    font-weight: 600; /* Sedikit lebih tebal agar jelas */
	    padding: 8px 10px !important; /* Jarak dalam sel */
	    vertical-align: middle !important;
	    white-space: nowrap; /* Header jangan sampai turun ke bawah */
	}

	/* Mengatur font pada Body (Isi Data) */
	#v_dataTable tbody td {
	    font-size: 14px !important;
	    padding: 8px 10px !important; 
	    vertical-align: middle !important; /* Teks sejajar tengah secara vertikal */
	    line-height: 1.4; /* Jarak antar baris teks agar tidak menumpuk */
	}

	/* Mengatur ukuran icon (seperti icon kalender/warning) agar tidak terlalu besar */
	#v_dataTable tbody td i, 
	#v_dataTable tbody td svg,
	#v_dataTable tbody td img {
	    font-size: 14px !important; 
	    width: 14px; 
	    height: 14px;
	    vertical-align: middle;
	    margin-right: 4px; /* Jarak antara icon dan teks */
	}
</style>

<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered text-sm text-nowrap table-hover dataTable" id="v_dataTable"
        width="100%" cellspacing="0">
        <thead class="bg-success text-light"></thead>
        <tbody></tbody>
    </table>
</div>