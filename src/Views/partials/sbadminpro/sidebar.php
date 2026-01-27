<?php
$logged_by = session()->get('logged_by');
$nameV = "";

$name = session()->get('name');
$username = session()->get('username');
$login_module = session()->get('login_module');

if ($name) {
    $nameV = $name;
} else {
    $nameV = $username;
}

$avatar = session()->get('avatar');

$login_module = session()->get('login_module');
$modules = session()->get('openapi2_modules');
?>

<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <?php
                if ($login_module == 'openapi2') { ?>
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        APP
                    </div>

                    <?php if ($modules) {
                        $modules_show = [];
                        foreach ($modules as $key => $value) {
                            $not_display = $value->not_display;
                            if ($not_display != 1) {
                                $modules_show[] = $value;
                            }
                        }

                        // start foreach
                        $parent_ids = [];
                        foreach ($modules_show as $key => $value) {
                            $module_id = $value->module_id;
                            $kode = 'mod_' . $value->kode;
                            $is_parent = $value->is_parent;
                            $is_child = $value->is_child;
                            $path = $value->path;
                            $allow_auto = $value->allow_auto;
                            $not_display = $value->not_display;

                            // if ($allow_auto != 1) {
                            if ($is_parent == 'on') {
                                $parent_ids[] = $module_id;
                            }

                            if (preg_match_all('/&[#A-Za-z0-9]+;/', $value->icon)) {
                                $icon = html_entity_decode($value->icon);
                            } else {
                                $icon = $value->icon;
                            } ?>

                            <!-- start nav-item -->
                            <li class="nav-item <?= (isset($group[0]) and $group[0] == $value->kode) ? 'active' : '' ?>">
                                <?php
                                /**
                                 * jika dia hanya parent
                                 * */
                                if ($is_parent == 'on' and $is_child == null) { ?>
                                    <a class="nav-link <?= (isset($group[0]) and $group[0] == $value->kode) ? '' : 'collapsed' ?>" href="#"
                                        data-toggle="collapse" data-target="#<?= $kode ?>" aria-expanded="true" aria-controls="collapseUtilities"
                                        id="<?= $value->kode ?>">
                                        <?= $icon ?>
                                        <span><?= $value->name ?></span>
                                    </a>
                                <?php } ?>

                                <div id="<?= $kode ?>" class="collapse <?= (isset($group[0]) and $group[0] == $value->kode) ? 'show' : '' ?>"
                                    aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <h6 class="collapse-header"><?= $value->category_name ?>:</h6>
                                        <!-- start foreach -->
                                        <?php foreach ($modules_show as $key2 => $value2) {
                                            $module_id2 = $value2->module_id;
                                            $kode2 = 'mod2_' . $value2->kode;
                                            $is_parent2 = $value2->is_parent;
                                            $is_child2 = $value2->is_child;
                                            $path2 = $value2->path;
                                            $badge_sum = $value2->badge_sum;
                                            $not_display2 = $value->not_display;
                                            echo $not_display2;

                                            /*start if*/
                                            if (preg_match_all('/&[#A-Za-z0-9]+;/', $value->icon)) {
                                                $icon2 = html_entity_decode($value2->icon);
                                            } else {
                                                $icon2 = $value2->icon;
                                            }
                                            /*end if*/

                                            /**
                                             * start if
                                             * jika dia child dari parent
                                             * */
                                            if ($is_parent2 == null and $is_child2 == $module_id) { ?>
                                                <a class="collapse-item <?= (isset($navlink) and $navlink == $value2->kode) ? 'active' : '' ?>"
                                                    href="<?= base_url() . 'admin/' . $value2->kode ?>" id="<?= $value2->kode ?>"><?= $value2->name; ?>
                                                    <?php
                                                    if ($badge_sum == 1) { ?>
                                                        <span class="badge badge-primary float-right">0</span>
                                                    <?php } ?>
                                                </a> <?php
                                            } /*end if*/

                                            /**
                                             * start if
                                             * jika dia parent dari parent
                                             * */
                                            if ($is_parent2 == 'on' and $is_child2 == $module_id) { ?>
                                                <a class="nav-link2 <?= (isset($group[1]) and $group[1] == $value2->kode) ? 'active' : 'collapsed' ?> collapse-item"
                                                    href="javascript:void(0);" data-toggle="collapse" data-target="#<?= $kode2 ?>" aria-expanded="false"
                                                    aria-controls="<?= $kode2 ?>">
                                                    <?= $value2->name; ?> <i class="bi bi-caret-right-fill"></i>
                                                </a>
                                                <!-- <? //= $group[1]; 
                                                        ?> -->
                                                <!-- <? //= $value2->kode; 
                                                        ?> -->
                                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu<?= $kode2 ?>">
                                                    <div class="collapse <?= (isset($group[1]) and $group[1] == $value2->kode) ? 'show' : '' ?>"
                                                        id="<?= $kode2 ?>" data-parent="#accordionSidenavAppsMenu<?= $kode2 ?>">
                                                        <nav class="sidenav-menu-nested nav">
                                                            <?php foreach ($modules as $key3 => $value3) {
                                                                // $module_id3 = $value3->module_id;
                                                                // $kode3 = 'mod3_' . $value3->kode;
                                                                $is_parent3 = $value3->is_parent;
                                                                $is_child3 = $value3->is_child;
                                                                // $path3 = $value3->path;
                                                                // $badge_sum = $value3->badge_sum;
                                                                /**
                                                                 * start if
                                                                 * jika dia child dari parent2
                                                                 * */
                                                                if ($is_parent3 == null and $is_child3 == $module_id2) { ?>
                                                                    <a class="nav-link2 collapse-item <?= (isset($navlink) and $navlink == $value3->kode) ? 'active' : '' ?>"
                                                                        href="<?= base_url() . 'admin/' . $value3->kode ?>" id="<?= $value3->kode ?>"
                                                                        style="width: 100%;">
                                                                        <?= $value3->name; ?>
                                                                        <!-- <? //= $navlink; 
                                                                                ?> -->
                                                                        <!-- <? //= $value3->kode; 
                                                                                ?> -->
                                                                    </a> <?php
                                                                }
                                                                /** end if */
                                                            } ?>
                                                        </nav>
                                                    </div>
                                                </nav> <?php
                                            } /*end if*/
                                        } ?>
                                        <!-- end foreach -->
                                    </div>
                                </div>
                            </li> <?php 
                        } 
                    } ?>

                    <!-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-cog"></i>
                            <span>Components</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Custom Components:</h6>
                                <a class="collapse-item" href="buttons.html">Buttons</a>
                                <a class="collapse-item" href="cards.html">Cards</a>
                            </div>
                        </div>
                    </li> -->

                    <?php if (session()->get('dorbitt_inz') == TRUE) { ?>
                        <li class="nav-item <?= (isset($group[0]) and $group[0] == 'payroll') ? 'active' : '' ?>">
                            <a class="nav-link <?= (isset($group[0]) and $group[0] == 'payroll') ? '' : 'collapsed' ?>" href="#"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="fa-brands fa-paypal"></i>
                                <span>Payroll</span>
                            </a>
                            <div id="collapseTwo" class="collapse <?= (isset($group[0]) and $group[0] == 'payroll') ? 'show' : '' ?>"
                                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Payroll client:</h6>
                                    <a class="collapse-item <?= (isset($navlink) and $navlink == 'employee_salary') ? 'active' : '' ?>"
                                        href="<?= base_url() ?>admin/payroll/employee_salary">Employee Salary</a>
                                    <a class="collapse-item <?= (isset($navlink) and $navlink == 'payslip') ? 'active' : '' ?>"
                                        href="<?= base_url() ?>admin/payroll/payslip">Payslip</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if (isset($ummuqu)) { ?>
                        <li class="nav-item <?= (isset($group[0]) and $group[0] == 'pm') ? 'active' : '' ?>">
                            <a class="nav-link <?= (isset($group[0]) and $group[0] == 'pm') ? '' : 'collapsed' ?>" href="#"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <!-- <i class="fa-regular fa-car-wrench"></i> -->
                                <i class="fa-light fa-screwdriver-wrench"></i>
                                <span>Plant Maitenance</span>
                            </a>
                            <div id="collapseTwo" class="collapse <?= (isset($group[0]) and $group[0] == 'pm') ? 'show' : '' ?>"
                                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Plant Maintentance:</h6>
                                    <a class="collapse-item <?= (isset($navlink) and $navlink == 'mechanic_activity') ? 'active' : '' ?>"
                                        href="<?= base_url() ?>admin/pm/mechanic_activity">Mechanic Activity</a>
                                    <a class="collapse-item <?= (isset($navlink) and $navlink == 'work_order_sap') ? 'active' : '' ?>"
                                        href="<?= base_url() ?>admin/pm/work_order_sap">Work Order SAP</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if (!isset($ummuqu) and ENVIRONMENT == 'developmentz') { ?>
                        <li class="nav-item <?= (isset($group[0]) and $group[0] == 'payment_request') ? 'active' : '' ?>">
                            <a class="nav-link <?= (isset($group[0]) and $group[0] == 'payment_request') ? '' : 'collapsed' ?>" href="#"
                                data-toggle="collapse" data-target="#collapsePaymentRequest" aria-expanded="true"
                                aria-controls="collapsePaymentRequest">
                                <i class="fal fa-money-check-edit-alt"></i>
                                <span>Payment Request</span>
                            </a>
                            <div id="collapsePaymentRequest"
                                class="collapse <?= (isset($group[0]) and $group[0] == 'payment_request') ? 'show' : '' ?>"
                                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">FINANCE:</h6>
                                    <a class="collapse-item <?= (isset($navlink) and $navlink == 'cash_payment_request') ? 'active' : '' ?>"
                                        href="<?= base_url() ?>admin/payment_request/cash">Cash Payment Request</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if (!isset($ummuqu) and ENVIRONMENT == 'developmentz') { ?>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseApps"
                                aria-expanded="true" aria-controls="collapseApps">
                                <i class="fa-solid fa-chart-simple"></i> <span>Syshab</span>
                            </a>
                            <div id="collapseApps" class="collapse <?= (isset($group[0]) and $group[0] == 'syshab') ? 'show' : '' ?>"
                                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Syshab:</h6>
                                    <!-- <a class="collapse-item <? //= (isset($navlink) and $navlink == 'iescm1') ? 'active' : '' 
                                                                    ?>"
                                        href="<? //= base_url() 
                                                ?>admin/iescm/satu">Satu</a>
                                    <a class="collapse-item <? //= (isset($navlink) and $navlink == 'iescm2') ? 'active' : '' 
                                                            ?>"
                                        href="<? //= base_url() 
                                                ?>admin/iescm/dua">Dua</a> -->

                                    <!-- Nested Sidenav Accordion (Apps -> Knowledge Base)-->
                                    <a class="nav-link2 collapsed collapse-item" href="javascript:void(0);" data-toggle="collapse"
                                        data-target="#appsCollapseKnowledgeBaseHR" aria-expanded="false"
                                        aria-controls="appsCollapseKnowledgeBaseHR">
                                        <span>HR</span>
                                    </a>
                                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenuHR">
                                        <div class="collapse" id="appsCollapseKnowledgeBaseHR" data-parent="#accordionSidenavAppsMenuHR"
                                            style="">
                                            <nav class="sidenav-menu-nested nav">
                                                <a class="nav-link2 collapse-item"
                                                    href="<?= base_url('admin/syshab/hr/employee') ?>">Employee</a>
                                                <!-- <a class="nav-link2 collapse-item" href="knowledge-base-home-2.html">Home 2</a>
                                                <a class="nav-link2 collapse-item" href="knowledge-base-category.html">Category</a>
                                                <a class="nav-link2 collapse-item" href="knowledge-base-article.html">Article</a> -->
                                            </nav>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                    <!-- Sidenav Menu Heading (Account)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <div class="sidenav-menu-heading d-sm-none">Account</div>
                    <!-- Sidenav Link (Alerts)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="bell"></i></div>
                        Alerts
                        <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                    </a>
                    <!-- Sidenav Link (Messages)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="mail"></i></div>
                        Messages
                        <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                    </a>
                    <!-- Sidenav Menu Heading (Core)-->
                    <div class="sidenav-menu-heading">Core</div>
                    <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                        <div class="nav-link-icon"><i data-feather="activity"></i></div>
                        Dashboards
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                            <a class="nav-link" href="dashboard-1.html">
                                Default
                                <span class="badge bg-primary-soft text-primary ms-auto">Updated</span>
                            </a>
                            <a class="nav-link" href="dashboard-2.html">Multipurpose</a>
                            <a class="nav-link" href="dashboard-3.html">Affiliate</a>
                        </nav>
                    </div>
                    <!-- Sidenav Heading (Custom)-->
                    <div class="sidenav-menu-heading">Custom</div>
                    <!-- Sidenav Accordion (Pages)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="nav-link-icon"><i data-feather="grid"></i></div>
                        Pages
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                            <!-- Nested Sidenav Accordion (Pages -> Account)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAccount" aria-expanded="false" aria-controls="pagesCollapseAccount">
                                Account
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAccount" data-bs-parent="#accordionSidenavPagesMenu">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="account-profile.html">Profile</a>
                                    <a class="nav-link" href="account-billing.html">Billing</a>
                                    <a class="nav-link" href="account-security.html">Security</a>
                                    <a class="nav-link" href="account-notifications.html">Notifications</a>
                                </nav>
                            </div>
                            <!-- Nested Sidenav Accordion (Pages -> Authentication)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Authentication
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" data-bs-parent="#accordionSidenavPagesMenu">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesAuth">
                                    <!-- Nested Sidenav Accordion (Pages -> Authentication -> Basic)-->
                                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuthBasic" aria-expanded="false" aria-controls="pagesCollapseAuthBasic">
                                        Basic
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuthBasic" data-bs-parent="#accordionSidenavPagesAuth">
                                        <nav class="sidenav-menu-nested nav">
                                            <a class="nav-link" href="auth-login-basic.html">Login</a>
                                            <a class="nav-link" href="auth-register-basic.html">Register</a>
                                            <a class="nav-link" href="auth-password-basic.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <!-- Nested Sidenav Accordion (Pages -> Authentication -> Social)-->
                                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuthSocial" aria-expanded="false" aria-controls="pagesCollapseAuthSocial">
                                        Social
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuthSocial" data-bs-parent="#accordionSidenavPagesAuth">
                                        <nav class="sidenav-menu-nested nav">
                                            <a class="nav-link" href="auth-login-social.html">Login</a>
                                            <a class="nav-link" href="auth-register-social.html">Register</a>
                                            <a class="nav-link" href="auth-password-social.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <!-- Nested Sidenav Accordion (Pages -> Error)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                Error
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" data-bs-parent="#accordionSidenavPagesMenu">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="error-400.html">400 Error</a>
                                    <a class="nav-link" href="error-401.html">401 Error</a>
                                    <a class="nav-link" href="error-403.html">403 Error</a>
                                    <a class="nav-link" href="error-404-1.html">404 Error 1</a>
                                    <a class="nav-link" href="error-404-2.html">404 Error 2</a>
                                    <a class="nav-link" href="error-500.html">500 Error</a>
                                    <a class="nav-link" href="error-503.html">503 Error</a>
                                    <a class="nav-link" href="error-504.html">504 Error</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="pricing.html">Pricing</a>
                            <a class="nav-link" href="invoice.html">Invoice</a>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Applications)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseApps" aria-expanded="false" aria-controls="collapseApps">
                        <div class="nav-link-icon"><i data-feather="globe"></i></div>
                        Applications
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseApps" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                            <!-- Nested Sidenav Accordion (Apps -> Knowledge Base)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#appsCollapseKnowledgeBase" aria-expanded="false" aria-controls="appsCollapseKnowledgeBase">
                                Knowledge Base
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="appsCollapseKnowledgeBase" data-bs-parent="#accordionSidenavAppsMenu">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="knowledge-base-home-1.html">Home 1</a>
                                    <a class="nav-link" href="knowledge-base-home-2.html">Home 2</a>
                                    <a class="nav-link" href="knowledge-base-category.html">Category</a>
                                    <a class="nav-link" href="knowledge-base-article.html">Article</a>
                                </nav>
                            </div>
                            <!-- Nested Sidenav Accordion (Apps -> User Management)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#appsCollapseUserManagement" aria-expanded="false" aria-controls="appsCollapseUserManagement">
                                User Management
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="appsCollapseUserManagement" data-bs-parent="#accordionSidenavAppsMenu">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="user-management-list.html">Users List</a>
                                    <a class="nav-link" href="user-management-edit-user.html">Edit User</a>
                                    <a class="nav-link" href="user-management-add-user.html">Add User</a>
                                    <a class="nav-link" href="user-management-groups-list.html">Groups List</a>
                                    <a class="nav-link" href="user-management-org-details.html">Organization Details</a>
                                </nav>
                            </div>
                            <!-- Nested Sidenav Accordion (Apps -> Posts Management)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#appsCollapsePostsManagement" aria-expanded="false" aria-controls="appsCollapsePostsManagement">
                                Posts Management
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="appsCollapsePostsManagement" data-bs-parent="#accordionSidenavAppsMenu">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="blog-management-posts-list.html">Posts List</a>
                                    <a class="nav-link" href="blog-management-create-post.html">Create Post</a>
                                    <a class="nav-link" href="blog-management-edit-post.html">Edit Post</a>
                                    <a class="nav-link" href="blog-management-posts-admin.html">Posts Admin</a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Flows)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseFlows" aria-expanded="false" aria-controls="collapseFlows">
                        <div class="nav-link-icon"><i data-feather="repeat"></i></div>
                        Flows
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseFlows" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="multi-tenant-select.html">Multi-Tenant Registration</a>
                            <a class="nav-link" href="wizard.html">Wizard</a>
                        </nav>
                    </div>
                    <!-- Sidenav Heading (UI Toolkit)-->
                    <div class="sidenav-menu-heading">UI Toolkit</div>
                    <!-- Sidenav Accordion (Layout)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="nav-link-icon"><i data-feather="layout"></i></div>
                        Layout
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <!-- Nested Sidenav Accordion (Layout -> Navigation)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseLayoutSidenavVariations" aria-expanded="false" aria-controls="collapseLayoutSidenavVariations">
                                Navigation
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutSidenavVariations" data-bs-parent="#accordionSidenavLayout">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Sidenav</a>
                                    <a class="nav-link" href="layout-dark.html">Dark Sidenav</a>
                                    <a class="nav-link" href="layout-rtl.html">RTL Layout</a>
                                </nav>
                            </div>
                            <!-- Nested Sidenav Accordion (Layout -> Container Options)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseLayoutContainers" aria-expanded="false" aria-controls="collapseLayoutContainers">
                                Container Options
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutContainers" data-bs-parent="#accordionSidenavLayout">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-boxed.html">Boxed Layout</a>
                                    <a class="nav-link" href="layout-fluid.html">Fluid Layout</a>
                                </nav>
                            </div>
                            <!-- Nested Sidenav Accordion (Layout -> Page Headers)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsPageHeaders" aria-expanded="false" aria-controls="collapseLayoutsPageHeaders">
                                Page Headers
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsPageHeaders" data-bs-parent="#accordionSidenavLayout">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="header-simplified.html">Simplified</a>
                                    <a class="nav-link" href="header-compact.html">Compact</a>
                                    <a class="nav-link" href="header-overlap.html">Content Overlap</a>
                                    <a class="nav-link" href="header-breadcrumbs.html">Breadcrumbs</a>
                                    <a class="nav-link" href="header-light.html">Light</a>
                                </nav>
                            </div>
                            <!-- Nested Sidenav Accordion (Layout -> Starter Layouts)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsStarterTemplates" aria-expanded="false" aria-controls="collapseLayoutsStarterTemplates">
                                Starter Layouts
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsStarterTemplates" data-bs-parent="#accordionSidenavLayout">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="starter-default.html">Default</a>
                                    <a class="nav-link" href="starter-minimal.html">Minimal</a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Components)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
                        <div class="nav-link-icon"><i data-feather="package"></i></div>
                        Components
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseComponents" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="alerts.html">Alerts</a>
                            <a class="nav-link" href="avatars.html">Avatars</a>
                            <a class="nav-link" href="badges.html">Badges</a>
                            <a class="nav-link" href="buttons.html">Buttons</a>
                            <a class="nav-link" href="cards.html">
                                Cards
                                <span class="badge bg-primary-soft text-primary ms-auto">Updated</span>
                            </a>
                            <a class="nav-link" href="dropdowns.html">Dropdowns</a>
                            <a class="nav-link" href="forms.html">
                                Forms
                                <span class="badge bg-primary-soft text-primary ms-auto">Updated</span>
                            </a>
                            <a class="nav-link" href="modals.html">Modals</a>
                            <a class="nav-link" href="navigation.html">Navigation</a>
                            <a class="nav-link" href="progress.html">Progress</a>
                            <a class="nav-link" href="step.html">Step</a>
                            <a class="nav-link" href="timeline.html">Timeline</a>
                            <a class="nav-link" href="toasts.html">Toasts</a>
                            <a class="nav-link" href="tooltips.html">Tooltips</a>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Utilities)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
                        <div class="nav-link-icon"><i data-feather="tool"></i></div>
                        Utilities
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseUtilities" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="animations.html">Animations</a>
                            <a class="nav-link" href="background.html">Background</a>
                            <a class="nav-link" href="borders.html">Borders</a>
                            <a class="nav-link" href="lift.html">Lift</a>
                            <a class="nav-link" href="shadows.html">Shadows</a>
                            <a class="nav-link" href="typography.html">Typography</a>
                        </nav>
                    </div>
                    <!-- Sidenav Heading (Addons)-->
                    <div class="sidenav-menu-heading">Plugins</div>
                    <!-- Sidenav Link (Charts)-->
                    <a class="nav-link" href="charts.html">
                        <div class="nav-link-icon"><i data-feather="bar-chart"></i></div>
                        Charts
                    </a>
                    <!-- Sidenav Link (Tables)-->
                    <a class="nav-link" href="tables.html">
                        <div class="nav-link-icon"><i data-feather="filter"></i></div>
                        Tables
                    </a>
                <?php  } ?>

                <?php if (is_file(APPPATH . "Views/partials/".config('Vh')->tmp()."/sidebar.php")) {
                    require APPPATH . "Views/partials/".config('Vh')->tmp()."/sidebar.php";
                } ?>
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title"><?= $nameV ?></div>
            </div>
        </div>
    </nav>
</div>
