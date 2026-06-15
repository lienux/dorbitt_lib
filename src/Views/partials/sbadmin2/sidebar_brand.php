<?php 
    $login_module = session()->get('login_module');
    $version = getenv('app.version');
?>

<?php if ($version) { ?>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img class="ummu-brand-icon" src="<?= config('Vh')->appLogo() ?>" alt="" width="30px">
            <div class="sidebar-brand-text mx-1"><?=config('Vh')->appName()?></div>
        </div>
    </a>
<?php } else { ?>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <?php if ($login_module == 'mcp') { ?>
                <img class="ummu-brand-icon img-fluid d-sm-none d-md-block" src="<?= base_url('assets/hillcon/images/text240.png') ?>" alt="" width="200px">
                <?php 
            } 
            elseif ($login_module == 'herp' OR session()->get('login_module') == 'iescm') { ?>
                <img class="ummu-brand-icon img-fluid d-sm-none d-md-block" src="<?= base_url('assets/hillcon/images/rect7597.png') ?>" alt="" width="200px">
                <?php
            }
            else { ?>
                <img class="ummu-brand-icon" src="<?= config('Vh')->appLogo() ?>" alt="" width="30px">
                <div class="sidebar-brand-text mx-1"><?=config('Vh')->appName()?></div>
                <?php 
            } ?>
        </div>
    </a>
<?php } ?>