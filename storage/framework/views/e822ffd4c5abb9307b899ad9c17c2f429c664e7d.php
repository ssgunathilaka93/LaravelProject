<?php $__env->startSection('content'); ?>
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Transaction for : <?php echo e(json_decode($data1[0])->auth_account->mobile); ?></div>
                </div>
                <div class="box-body">

						<?php $__currentLoopData = $data3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<div class="col-md-6 col-md-offset-2">
										<label class="control-label">Client No</label>
										<input type="text" class="form-control" value="<?php echo e($row->client); ?>" readonly>
										
										<label class="control-label">Total Amount</label>
										<input type="text" class="form-control" value="<?php echo e($row->Tot_amount); ?>" readonly>
										
										<label class="control-label">Last Charging Date</label>
										<input type="text" class="form-control" value="<?php echo e($row->last_charge); ?>" readonly>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
                </div>
            </div>
        </div>
    </div>
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