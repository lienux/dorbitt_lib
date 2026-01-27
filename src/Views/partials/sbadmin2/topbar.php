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
<!-- Topbar -->
<?php
if ($login_module == 'mcp') { ?>
    <nav class="navbar navbar-expand topbar static-top" style="height: 3rem; background-color: rgba(0, 0, 0, 1) !important;">
    <?php
} else { ?>
        <nav class="navbar navbar-expand navbar-lightz bg-whitez bg-primaryz topbar static-top" style="height: 3rem; background-color: #350059 !important;">
        <?php
    } ?>
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-nonez rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form> -->

        <div class="h5 text-light my-0"><?= (isset($page_title) ? $page_title : '') ?></div>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
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
            <!-- include('bocahgantengdotcom.partials.notification') -->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-light small"><?= $nameV ?></span>
                    <img class="img-profile rounded-circle" src="<?= $vH->avatar() ?>">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= base_url('admin/config_profile') ?>">
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
                        <a class="dropdown-item" href="<?= base_url('admin/config_profile/session') ?>">
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