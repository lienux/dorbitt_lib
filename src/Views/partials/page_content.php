<div id="ummuPageContent">
    <nav class="ummu-nav">
        <div class="nav nav-tabs" id="ummu_nav_tab">
            <button class="nav-link btn-nav-link-form mr-1 active" id="nav-tab-form" data-toggle="tab" data-target="#nav-form" type="button"
                role="tab" aria-selected="true">
                <span class="d-none d-sm-block"><i class="far fa-clipboard-list"></i> Form</span>
                <span class="d-block d-sm-none"><i class="far fa-clipboard-list"></i></span>
            </button>
            <button class="nav-link btn-nav-link-table mr-1" id="nav-tab-listData" data-toggle="tab" data-target="#nav-listData" type="button" role="tab"
                aria-selected="false">
                <span class="d-none d-sm-block"><i class="far fa-list-alt"></i> List Data</span>
                <span class="d-block d-sm-none"><i class="far fa-list-alt"></i></span>
            </button>
        </div>
    </nav>
    <div class="section-body">
        <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
            <div class="card-body pt-2">
                <div class="tab-content" id="ummu_tab_contnet">
                    <div class="tab-pane fade show active" id="nav-form" role="tabpanel">
                        <?= $this->include(config('Vh')->ummuView($dir_views . 'form')) ?>
                    </div>
                    <div class="tab-pane fade" id="nav-listData" role="tabpanel">
                        <?= $this->include(config('Vh')->ummuView($dir_views . 'table')) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('partials/modal') ?>
</div>