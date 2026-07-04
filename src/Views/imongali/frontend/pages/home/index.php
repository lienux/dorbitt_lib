<?= $this->extend(config('Ummu')->Views($appType.'/frontend/layout/index')) ?>

<?= $this->section('content') ?>
    <div id="data-container"></div>
    <div id="loader" class="collapse">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <p>Memuat data lebih banyak...</p>
    </div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js"></script> -->
    <!-- <script type="module" src="<?//=base_url();?>/app/Controllers/MahasiswaController.js"></script> -->
    <!-- <script type="module" src="<?//=base_url();?>js/pages/dashboard/index.js"></script> -->
    <script>
        var base_url = '<?=base_url()?>';
        var page = 1;          // Halaman awal
        var isLoading = false; // Flag agar tidak terjadi double request saat scroll cepat
        var isLastPage = false; // Flag jika data di server sudah habis

        // Fungsi untuk mengambil data dari server
        function loadMoreData(pageNumber) {
            if (isLoading || isLastPage) return; // Hentikan jika sedang loading atau data sudah habis

            isLoading = true;
            $("#loader").show(); // Tampilkan teks loading

            $.ajax({
                url: `<?=base_url()?>blog/show_activity?page=${pageNumber}`,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    // Asumsi server mengembalikan object: { data: [...], is_last: false }
                    
                    if (response.rows.length > 0) {
                        // Loop data dan masukkan ke dalam container
                        response.rows.forEach(function(item) {
                            var html = `
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="activity">
                                                <div class="post">
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm" src="${base_url}favicon.ico" alt="user image">
                                                        <span class="username">
                                                            <a href="#">${item.subject}</a>
                                                        </span>
                                                        <span class="description">${item.created_at}</span>
                                                    </div>
                                                    <p>${item.content}</p>
                                                    <p>
                                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $("#data-container").append(html);
                            // console.log(item)
                        });
                        
                        // Cek apakah ini halaman terakhir berdasarkan info dari server
                        if (response.is_last) {
                            isLastPage = true;
                            $("#loader").html("<p>Semua data telah ditampilkan.</p>").show();
                        }
                    } else {
                        isLastPage = true;
                        $("#loader").html("<p>Semua data telah ditampilkan.</p>").show();
                    }
                },
                error: function(xhr) {
                    console.error("Gagal memuat data", xhr.responseText);
                },
                complete: function() {
                    isLoading = false;
                    if (!isLastPage) {
                        $("#loader").hide(); // Sembunyikan loader jika masih ada data selanjutnya
                    }
                }
            });
        }

        // 1. Muat data pertama kali saat halaman dibuka
        $(document).ready(function() {
            loadMoreData(page);
        });

        // 2. Deteksi Event Scroll Event pada Window Browser
        $(window).on("scroll", function() {
            // $(window).scrollTop() = Jarak scroll dari atas
            // $(window).height()    = Tinggi layar browser yang terlihat
            // $(document).height()  = Total tinggi seluruh dokumen web
            
            // Kita beri toleransi 100px sebelum benar-benar mentok bawah untuk memicu load data
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                if (!isLoading && !isLastPage) {
                    page++; // Naikkan nomor halaman
                    loadMoreData(page); // Panggil fungsi AJAX
                }
            }
        });
    </script>
<?= $this->endSection() ?>