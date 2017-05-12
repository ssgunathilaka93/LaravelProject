<?php $__env->startSection('header'); ?>
	<section class="content-header">
	  <h1>
	    <?php echo e(trans('backpack::logmanager.log_manager')); ?><small><?php echo e(trans('backpack::logmanager.log_manager_description')); ?></small>
	  </h1>
	  <ol class="breadcrumb">
      <li><a href="<?php echo e(url(config('backpack.base.route_prefix'),'dashboard')); ?>"><?php echo e(trans('backpack::crud.admin')); ?></a></li>
      <li><a href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/log')); ?>"><?php echo e(trans('backpack::logmanager.log_manager')); ?></a></li>
      <li class="active"><?php echo e(trans('backpack::logmanager.preview')); ?></li>
	  </ol>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <a href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/log')); ?>"><i class="fa fa-angle-double-left"></i> <?php echo e(trans('backpack::logmanager.back_to_all_logs')); ?></a><br><br>
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <h3><?php echo e(\Carbon\Carbon::createFromTimeStamp($log['last_modified'])->formatLocalized('%d %B %Y')); ?>:</h3>
      <pre>
        <code>
          <?php echo e($log['content']); ?>

        </code>
      </pre>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/styles/default.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>