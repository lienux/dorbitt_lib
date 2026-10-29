<!-- HEADER -->
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h4 class="mb-0"><i class="fas fa-user-shield text-primary mr-2"></i>Timesheet Kapal — PIC / Admin</h4>
        <small class="text-muted">Kelola timesheet crew kapal per IJO / Shipping</small>
    </div>
    <div class="text-right">
        <div class="font-weight-bold"><?= esc(session()->get('name')) ?></div>
        <small class="text-muted">
            <i class="fas fa-user-shield mr-1"></i><?= esc(session()->get('role') ?? 'PIC/Admin') ?>
            • NIK: <?= esc(session()->get('nika')) ?>
        </small>
        <?php if (!empty($pic_name)): ?>
            <div class="mt-1">
                <span class="pic-info">
                    <i class="fas fa-user-tie"></i>
                    PIC: <strong><?= esc($pic_name) ?></strong>
                    <?php if (!empty($pic_phone)): ?>
                        <span class="ml-2"><i class="fas fa-phone-alt"></i> <?= esc($pic_phone) ?></span>
                    <?php endif; ?>
                </span>
            </div>
        <?php endif; ?>
    </div>
</div>