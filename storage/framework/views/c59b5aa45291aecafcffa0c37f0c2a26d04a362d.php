<?php $__env->startSection('after_styles'); ?>
    <!-- Ladda Buttons (loading buttons) -->
    <link href="<?php echo e(asset('vendor/backpack/ladda/ladda-themeless.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
	<section class="content-header">
	  <h1>
	    <?php echo e(trans('backpack::backup.backup')); ?>

	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/dashboard')); ?>">Admin</a></li>
	    <li class="active"><?php echo e(trans('backpack::backup.backup')); ?></li>
	  </ol>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <button id="create-new-backup-button" href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/backup/create')); ?>" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> <?php echo e(trans('backpack::backup.create_a_new_backup')); ?></span></button>
      <br>
      <h3><?php echo e(trans('backpack::backup.existing_backups')); ?>:</h3>
      <table class="table table-hover table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th><?php echo e(trans('backpack::backup.location')); ?></th>
            <th><?php echo e(trans('backpack::backup.date')); ?></th>
            <th class="text-right"><?php echo e(trans('backpack::backup.file_size')); ?></th>
            <th class="text-right"><?php echo e(trans('backpack::backup.actions')); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <th scope="row"><?php echo e($k+1); ?></th>
            <td><?php echo e($b['disk']); ?></td>
            <td><?php echo e(\Carbon\Carbon::createFromTimeStamp($b['last_modified'])->formatLocalized('%d %B %Y, %H:%M')); ?></td>
            <td class="text-right"><?php echo e(round((int)$b['file_size']/1048576, 2).' MB'); ?></td>
            <td class="text-right">
                <?php if($b['download']): ?>
                <a class="btn btn-xs btn-default" href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/backup/download/')); ?>?disk=<?php echo e($b['disk']); ?>&path=<?php echo e(urlencode($b['file_path'])); ?>&file_name=<?php echo e(urlencode($b['file_name'])); ?>"><i class="fa fa-cloud-download"></i> <?php echo e(trans('backpack::backup.download')); ?></a>
                <?php endif; ?>
                <a class="btn btn-xs btn-danger" data-button-type="delete" href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/backup/delete/'.$b['file_name'])); ?>?disk=<?php echo e($b['disk']); ?>"><i class="fa fa-trash-o"></i> <?php echo e(trans('backpack::backup.delete')); ?></a>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
    <!-- Ladda Buttons (loading buttons) -->
    <script src="<?php echo e(asset('vendor/backpack/ladda/spin.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/backpack/ladda/ladda.js')); ?>"></script>

<script>
  jQuery(document).ready(function($) {

    // capture the Create new backup button
    $("#create-new-backup-button").click(function(e) {
        e.preventDefault();
        var create_backup_url = $(this).attr('href');
        // Create a new instance of ladda for the specified button
        var l = Ladda.create( document.querySelector( '#create-new-backup-button' ) );

        // Start loading
        l.start();

        // Will display a progress bar for 10% of the button width
        l.setProgress( 0.3 );

        setTimeout(function(){ l.setProgress( 0.6 ); }, 2000);

        // do the backup through ajax
        $.ajax({
                url: create_backup_url,
                type: 'PUT',
                success: function(result) {
                    l.setProgress( 0.9 );
                    // Show an alert with the result
                    if (result.indexOf('failed') >= 0) {
                        new PNotify({
                            title: "<?php echo e(trans('backpack::backup.create_warning_title')); ?>",
                            text: "<?php echo e(trans('backpack::backup.create_warning_message')); ?>",
                            type: "warning"
                        });
                    }
                    else
                    {
                        new PNotify({
                            title: "<?php echo e(trans('backpack::backup.create_confirmation_title')); ?>",
                            text: "<?php echo e(trans('backpack::backup.create_confirmation_message')); ?>",
                            type: "success"
                        });
                    }

                    // Stop loading
                    l.setProgress( 1 );
                    l.stop();

                    // refresh the page to show the new file
                    setTimeout(function(){ location.reload(); }, 3000);
                },
                error: function(result) {
                    l.setProgress( 0.9 );
                    // Show an alert with the result
                    new PNotify({
                        title: "<?php echo e(trans('backpack::backup.create_error_title')); ?>",
                        text: "<?php echo e(trans('backpack::backup.create_error_message')); ?>",
                        type: "warning"
                    });
                    // Stop loading
                    l.stop();
                }
            });
    });

    // capture the delete button
    $("[data-button-type=delete]").click(function(e) {
        e.preventDefault();
        var delete_button = $(this);
        var delete_url = $(this).attr('href');

        if (confirm("<?php echo e(trans('backpack::backup.delete_confirm')); ?>") == true) {
            $.ajax({
                url: delete_url,
                type: 'DELETE',
                success: function(result) {
                    // Show an alert with the result
                    new PNotify({
                        title: "<?php echo e(trans('backpack::backup.delete_confirmation_title')); ?>",
                        text: "<?php echo e(trans('backpack::backup.delete_confirmation_message')); ?>",
                        type: "success"
                    });
                    // delete the row from the table
                    delete_button.parentsUntil('tr').parent().remove();
                },
                error: function(result) {
                    // Show an alert with the result
                    new PNotify({
                        title: "<?php echo e(trans('backpack::backup.delete_error_title')); ?>",
                        text: "<?php echo e(trans('backpack::backup.delete_error_message')); ?>",
                        type: "warning"
                    });
                }
            });
        } else {
            new PNotify({
                title: "<?php echo e(trans('backpack::backup.delete_cancel_title')); ?>",
                text: "<?php echo e(trans('backpack::backup.delete_cancel_message')); ?>",
                type: "info"
            });
        }
      });

  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>