<?php $__env->startSection('header'); ?>
	<section class="content-header">
	  <h1>
	    <?php echo e(trans('backpack::langfilemanager.translate')); ?> <span class="text-lowercase"><?php echo e(trans('backpack::langfilemanager.site_texts')); ?></span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/dashboard')); ?>"><?php echo e(trans('backpack::crud.admin')); ?></a></li>
	    <li><a href="<?php echo e(url($crud->route)); ?>" class="text-capitalize"><?php echo e($crud->entity_name_plural); ?></a></li>
	    <li class="active"><?php echo e(trans('backpack::crud.edit')); ?> <?php echo e(trans('backpack::langfilemanager.texts')); ?></li>
	  </ol>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Default box -->
  <div class="box">
  	<div class="box-header with-border">
	  <h3 class="box-title"><?php echo e(ucfirst(trans('backpack::langfilemanager.language'))); ?>:
		<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($currentLang == $lang->abbr): ?>
				<?php echo e($lang->name); ?>

			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<small>
			 &nbsp; <?php echo e(trans('backpack::langfilemanager.switch_to')); ?>: &nbsp;
			<select name="language_switch" id="language_switch">
				<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e(url(config('backpack.base.route_prefix', 'admin')."/language/texts/{$lang->abbr}")); ?>" <?php echo e($currentLang == $lang->abbr ? 'selected' : ''); ?>><?php echo e($lang->name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</small>
	  </h3>
	</div>
    <div class="box-body">
    	<p><em><?php echo trans('backpack::langfilemanager.rules_text'); ?></em></p>
    	<br>
		<ul class="nav nav-tabs">
			<?php $__currentLoopData = $langFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li class="<?php echo e($file['active'] ? 'active' : ''); ?>">
				<a href="<?php echo e($file['url']); ?>"><?php echo e($file['name']); ?></a>
			</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
		<div class="clearfix"></div>
		<br>
		<section class="lang-inputs">
		<?php if(!empty($fileArray)): ?>
			<?php echo Form::open(array('url' => url(config('backpack.base.route_prefix', 'admin')."/language/texts/{$currentLang}/{$currentFile}"), 'method' => 'post', 'id' => 'lang-form', 'class' => 'form-horizontal', 'data-required' => trans('admin.language.fields_required'))); ?>

				<?php echo Form::button(trans('backpack::crud.save'), array('type' => 'submit', 'class' => 'btn btn-success submit pull-right hidden-xs hidden-sm', 'style' => "margin-top: -60px;")); ?>

				<div class="form-group hidden-sm hidden-xs">
					<div class="col-sm-2 text-right">
						<h4><?php echo e(trans('backpack::langfilemanager.key')); ?></h4>
					</div>
					<div class="hidden-sm hidden-xs col-md-5">
						<h4><?php echo e(trans('backpack::langfilemanager.language_text', ['language_name' => $browsingLangObj->name])); ?></h4>
					</div>
					<div class="col-sm-10 col-md-5">
						<h4><?php echo e(trans('backpack::langfilemanager.language_translation', ['language_name' => $currentLangObj->name])); ?></h4>
					</div>
				</div>
				<?php echo $langfile->displayInputs($fileArray); ?>

				<hr>
				<div class="text-center">
					<?php echo Form::button(trans('backpack::crud.save'), array('type' => 'submit', 'class' => 'btn btn-success submit')); ?>

				</div>
			<?php echo Form::close(); ?>

		<?php else: ?>
			<em><?php echo e(trans('backpack::langfilemanager.empty_file')); ?></em>
		<?php endif; ?>
	</section>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
	<script>
		jQuery(document).ready(function($) {
			$("#language_switch").change(function() {
				window.location.href = $(this).val();
			})
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>