<?php $__env->startSection('header'); ?>
    <section class="content-header">
      <h1>
        <?php echo e(trans('backpack::logmanager.log_manager')); ?><small><?php echo e(trans('backpack::logmanager.log_manager_description')); ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url(config('backpack.base.route_prefix'),'dashboard')); ?>"><?php echo e(trans('backpack::crud.admin')); ?></a></li>
        <li><a href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/log')); ?>"><?php echo e(trans('backpack::logmanager.log_manager')); ?></a></li>
        <li class="active"><?php echo e(trans('backpack::logmanager.existing_logs')); ?></li>
      </ol>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <table class="table table-hover table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th><?php echo e(trans('backpack::logmanager.date')); ?></th>
            <th><?php echo e(trans('backpack::logmanager.last_modified')); ?></th>
            <th class="text-right"><?php echo e(trans('backpack::logmanager.file_size')); ?></th>
            <th><?php echo e(trans('backpack::logmanager.actions')); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <th scope="row"><?php echo e($k+1); ?></th>
            <td><?php echo e(\Carbon\Carbon::createFromTimeStamp($log['last_modified'])->formatLocalized('%d %B %Y')); ?></td>
            <td><?php echo e(\Carbon\Carbon::createFromTimeStamp($log['last_modified'])->formatLocalized('%H:%M')); ?></td>
            <td class="text-right"><?php echo e(round((int)$log['file_size']/1048576, 2).' MB'); ?></td>
            <td>
                <a class="btn btn-xs btn-default" href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/log/preview/'.$log['file_name'])); ?>"><i class="fa fa-eye"></i> <?php echo e(trans('backpack::logmanager.preview')); ?></a>
                <a class="btn btn-xs btn-default" href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/log/download/'.$log['file_name'])); ?>"><i class="fa fa-cloud-download"></i> <?php echo e(trans('backpack::logmanager.download')); ?></a>
                <a class="btn btn-xs btn-danger" data-button-type="delete" href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/log/delete/'.$log['file_name'])); ?>"><i class="fa fa-trash-o"></i> <?php echo e(trans('backpack::logmanager.delete')); ?></a>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
<script>
  jQuery(document).ready(function($) {

    // capture the delete button
    $("[data-button-type=delete]").click(function(e) {
        e.preventDefault();
        var delete_button = $(this);
        var delete_url = $(this).attr('href');

        if (confirm("<?php echo e(trans('backpack::logmanager.delete_confirm')); ?>") == true) {
            $.ajax({
                url: delete_url,
                type: 'DELETE',
                data: {
                  _token: "<?php echo csrf_token(); ?>"
                },
                success: function(result) {
                    // delete the row from the table
                    delete_button.parentsUntil('tr').parent().remove();

                    // Show an alert with the result
                    new PNotify({
                        title: "<?php echo e(trans('backpack::logmanager.delete_confirmation_title')); ?>",
                        text: "<?php echo e(trans('backpack::logmanager.delete_confirmation_message')); ?>",
                        type: "success"
                    });
                },
                error: function(result) {
                    // Show an alert with the result
                    new PNotify({
                        title: "<?php echo e(trans('backpack::logmanager.delete_error_title')); ?>",
                        text: "<?php echo e(trans('backpack::logmanager.delete_error_message')); ?>",
                        type: "warning"
                    });
                }
            });
        } else {
            new PNotify({
                title: "<?php echo e(trans('backpack::logmanager.delete_cancel_title')); ?>",
                text: "<?php echo e(trans('backpack::logmanager.delete_cancel_message')); ?>",
                type: "info"
            });
        }
      });

  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>