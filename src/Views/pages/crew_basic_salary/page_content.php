<?= (isset($page_content_title)) ? $page_content_title : '' ?>

<div id="ummuPageContent">
    <div class="card mb-3 rounded-0 rounded-bottom">
        <div class="card-body pt-2">
            <?php
                if (is_file(VENDORPATH . 'dorbitt/lib/src/Views/' . $dir_views . 'table.php')) {
                    echo $this->include(config('Ummu')->Views($dir_views . 'table'));
                }else{
                    echo $this->include(config('Ummu')->Views('partials/table'));
                }
            ?>
            <div class="pt-2" id="dtNote">
                <div class="alert alert-warning collapse" role="alert" id="info_localStorage_true">
                    Anda mengaktifkan penyimpanan data sementara pada localStorage, untuk mendapatkan data terbaru silahkan klik button <span class='font-weight-bold text-danger'>Get Data</span> di atas
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('partials/modal') ?>
</div>