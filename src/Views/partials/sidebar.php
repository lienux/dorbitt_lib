<?php
$login_module = session()->get('login_module');
$modules = session()->get('openapi2_modules');

if ($login_module == 'dorbitt') { ?>
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
<?php  } ?>

<?php if (is_file(APPPATH . "Views/partials/sidebar.php")) {
    require APPPATH . "Views/partials/sidebar.php";
} ?>

<!-- Divider -->
<hr class="sidebar-divider">