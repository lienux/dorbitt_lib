
<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <?php foreach ($activity->rows as $key => $item) { ?>
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?=base_url()?>favicon.ico" alt="user image">
                            <span class="username">
                                <a href="#"><?=$item->subject?></a>
                            </span>
                            <span class="description"><?=$item->created_at?></span>
                        </div>
                        <p><?=$item->content?></p>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <?php if ($item->file1) { ?>
                                    <img class="img-fluid" src="<?=base_url('imongali/assets/images/activity/'.$item->file1)?>" alt="Photo">
                                <?php } ?>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?php if ($item->file2) { ?>
                                            <img class="img-fluid mb-3" src="<?=base_url('imongali/assets/images/activity/'.$item->file2)?>" alt="Photo">
                                        <?php } ?>
                                        <?php if ($item->file3) { ?>
                                            <img class="img-fluid" src="<?=base_url('imongali/assets/images/activity/'.$item->file3)?>" alt="Photo">
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php if ($item->file4) { ?>
                                            <img class="img-fluid mb-3" src="<?=base_url('imongali/assets/images/activity/'.$item->file4)?>" alt="Photo">
                                        <?php } ?>
                                        <?php if ($item->file1) { ?>
                                            <img class="img-fluid" src="<?=base_url('imongali/assets/images/activity/'.$item->file1)?>" alt="Photo">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>
                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        </p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>