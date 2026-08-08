<?php
    use Dorbitt\Helpers\ViewsHelper;

    $vH = new ViewsHelper();

    $logged_by = session()->get('logged_by');
    $nameV = "";

    /*if ($logged_by == "herp") {
        $name = session()->get('name');
    }elseif ($logged_by == "phone") {
        $nameV = session()->get('phone_number');
    }else{
        $nameV = session()->get('dorbitt_username');
    }*/

    $name = session()->get('name');
    $username = session()->get('username');
    $login_module = session()->get('login_module');

    if ($name) {
        $nameV = $name;
    } else {
        $nameV = $username;
    }

    $avatar = session()->get('avatar');
    // if ($avatar) {
    //     if (file_exists(base_url($avatar))) {
    //         $avatar = base_url($avatar);
    //     } else {
    //         $avatar = base_url('avatar_default.png');
    //     }
    // } else {
    //     $avatar = base_url('avatar_default.png');
    // }
?>

<!-- Sidebar Toggle (Topbar) -->
<?php if ($login_module == 'mcp') { ?>
<nav class="navbar navbar-expand topbar static-top" style="background-color: rgba(0, 0, 0, 1) !important;">
<?php } else { ?>
<nav class="navbar navbar-expand topbar static-top">
<?php } ?>
    <!-- <button id="sidebarToggleTop" class="btn btn-link d-md-nonez rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button> -->
    <button id="toggleSidebarModalBtn" class="btn btn-light mr-3">
        <span class="d-none d-sm-block"><i class="bi bi-grid-fill"></i> Apps</span>
        <span class="d-block d-sm-none"><i class="bi bi-grid-fill"></i></span>
    </button>

    <div class="h5 text-light my-0 collapse"><?= (isset($page_title) ? $page_title : '') ?></div>

    <!-- Menu module yang terkait -->
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbars02" aria-controls="navbars02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbars02">
        <ul class="navbar-nav mr-auto text-light">
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-home d-inline d-lg-none"></i>
                    <span class="d-none d-lg-inline ml-2">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-link d-inline d-lg-none"></i>
                    <span class="d-none d-lg-inline ml-2">Link</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">
                    <i class="fas fa-shopping-cart d-inline d-lg-none"></i>
                    <span class="d-none d-lg-inline ml-2">Disabled</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-caret-square-down d-inline d-lg-none"></i>
                    <span class="d-none d-lg-inline ml-2">Dropdown</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="customDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cog fa-fw d-inline d-lg-none"></i>
                    <span class="d-none d-lg-inline ml-2">Pengaturan</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="customDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-sliders-h fa-sm fa-fw mr-2 text-gray-400"></i>
                        Opsi A
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-tools fa-sm fa-fw mr-2 text-gray-400"></i>
                        Opsi B
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-question-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                        Bantuan
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto text-light">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none collapse">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Notification -->
        <?= $this->include(config('Vh')->ummuView('partials/' . config('Vh')->tmp() . '/sidebar_alert')) ?>
        <?= $this->include(config('Vh')->ummuView('partials/' . config('Vh')->tmp() . '/sidebar_msg')) ?>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline small"><?= $nameV ?></span>
                <img class="img-profile rounded-circle" src="<?= $vH->avatar() ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('admin/config_profile') ?>" target="_blank">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#" id="config_settings">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#" id="config_logactivity">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <?php if (ENVIRONMENT == 'development') { ?>
                    <a class="dropdown-item" href="<?= base_url('admin/config_profile/session') ?>" target="_blank">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Session
                    </a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->