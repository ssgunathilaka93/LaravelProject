<?php if($crud->hasAccess('update')): ?>
	<?php if(!$crud->model->translationEnabled()): ?>

	<!-- Single edit button -->
	<a href="<?php echo e(url($crud->route.'/'.$entry->getKey().'/edit')); ?>" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> <?php echo e(trans('backpack::crud.edit')); ?></a>

	<?php else: ?>

	<!-- Edit button group -->
	<div class="btn-group">
	  <a href="<?php echo e(url($crud->route.'/'.$entry->getKey().'/edit')); ?>" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> <?php echo e(trans('backpack::crud.edit')); ?></a>
	  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <span class="caret"></span>
	    <span class="sr-only">Toggle Dropdown</span>
	  </button>
	  <ul class="dropdown-menu">
  	    <li class="dropdown-header">EDIT TRANSLATION:</li>
	  	<?php $__currentLoopData = $crud->model->getAvailableLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		  	<li><a href="<?php echo e(url($crud->route.'/'.$entry->getKey().'/edit')); ?>?locale=<?php echo e($key); ?>"><?php echo e($locale); ?></a></li>
	  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  </ul>
	</div>

	<?php endif; ?>
<?php endif; ?>