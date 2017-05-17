<?php $__env->startSection('content-header'); ?>
	<section class="content-header">
	  <h1>
	    <?php echo e(trans('backpack::crud.preview')); ?> <span class="text-lowercase"><?php echo e($crud->entity_name); ?></span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="<?php echo e(url(config('backpack.base.route_prefix'), 'dashboard')); ?>"><?php echo e(trans('backpack::crud.admin')); ?></a></li>
	    <li><a href="<?php echo e(url($crud->route)); ?>" class="text-capitalize"><?php echo e($crud->entity_name_plural); ?></a></li>
	    <li class="active"><?php echo e(trans('backpack::crud.preview')); ?></li>
	  </ol>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php if($crud->hasAccess('list')): ?>
		<a href="<?php echo e(url($crud->route)); ?>"><i class="fa fa-angle-double-left"></i> <?php echo e(trans('backpack::crud.back_to_all')); ?> <span class="text-lowercase"><?php echo e($crud->entity_name_plural); ?></span></a><br><br>
	<?php endif; ?>

	<!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">
            <?php echo e(trans('backpack::crud.preview')); ?>

            <span class="text-lowercase"><?php echo e($crud->entity_name); ?></span>
          </h3>
	    </div>
	    <div class="box-body">
	      <?php echo e(dump($entry)); ?>

	    </div><!-- /.box-body -->
	  </div><!-- /.box -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('after_styles'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/crud/css/crud.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/crud/css/show.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
	<script src="<?php echo e(asset('vendor/backpack/crud/js/crud.js')); ?>"></script>
	<script src="<?php echo e(asset('vendor/backpack/crud/js/show.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>