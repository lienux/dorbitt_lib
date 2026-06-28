<?= $this->extend('admin/layout/index') ?>

<?= $this->section('content') ?>

<?php

	if ($rows) {
		$id = $rows['id'];
		$active = $rows['active'];
		$logo = $rows['logo'];
		$subject = $rows['subject'];
		$content = $rows['content'];
		$mode = 'update/'.$id;
	}else{
		$mode = 'create';
		$active = '';
	}
?>

<div class="row">
	<div class="col-md-12">
		<div class="card card-outline card-info">
			<form action="<?=base_url()?>admin/activity/<?=$mode?>" method="POST">
				<div class="card-header">
					<h3 class="card-title">
						Form Input
					</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="row">
						<div class="col">
							<div class="form-group">
			                    <label >Logo</label>
			                    <div class="row">
			                    	<div class="col-2">
			                    		<img class="img-circle img-bordered-sm" src="<?=base_url()?>favicon.ico" alt="user image">
			                    	</div>
			                    	<div class="col-10">
			                    		<input type="file" class="form-control" id="logo" name="logo" value="<?=(isset($rows['logo'])) ? $rows['logo'] : "" ?>">
			                    	</div>
			                    </div>
			                </div>
						</div>
						<div class="col">
							<div class="form-group">
			                    <label >Subject</label>
			                    <input type="text" class="form-control" id="subject" name="subject" value="<?=(isset($rows['subject'])) ? $rows['subject'] : "" ?>">
			                </div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
			                    <label >Active</label>
			                    <div class="custom-control custom-switch">
			                      	<input type="checkbox" class="custom-control-input" id="active" name="active" <?=($active) ? 'checked' : '' ?>>
			                      	<label class="custom-control-label" for="active"></label>
			                    </div>
			                </div>
						</div>
					</div>
	                <label for="exampleInputEmail1">Content</label>
					<textarea id="summernote" rows="5" name="content">
						<?=(isset($rows['content'])) ? $rows['content'] : "" ?>
					</textarea>
				</div>
				<div class="card-footer">
	                <a href="<?=base_url()?>admin/activity" class="btn btn-default">Cancel</a>
					<button type="submit" class="btn btn-info">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /.col-->
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<script>
	$(function () {
// Summernote
		$('#summernote').summernote({
			height: 300,
  			focus: true
		})

// CodeMirror
		CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
			mode: "htmlmixed",
			theme: "monokai"
		});
	})
</script>

<?= $this->endSection() ?>