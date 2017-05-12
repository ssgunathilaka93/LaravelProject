<?php $__env->startSection('after_scripts'); ?>
    <!-- jQuery and jQuery UI (REQUIRED) -->
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/elfinder.min.css') ?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/theme.css') ?>"> -->
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/backpack/elfinder/elfinder.backpack.theme.css') ?>">

    <!-- elFinder JS (REQUIRED) -->
    <script src="<?= asset($dir.'/js/elfinder.min.js') ?>"></script>

    <?php if ($locale) { ?>
    <!-- elFinder translation (OPTIONAL) -->
    <script src="<?= asset($dir."/js/i18n/elfinder.$locale.js") ?>"></script>
    <?php } ?>

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $().ready(function() {
            $('#elfinder').elfinder({
                // set your elFinder options here
                <?php if ($locale) { ?>
                    lang: '<?= $locale ?>', // locale
                <?php } ?>
                customData: {
                    _token: '<?= csrf_token() ?>'
                },
                url : '<?= route("elfinder.connector") ?>'  // connector URL
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <section class="content-header">
      <h1>
        <?php echo e(trans('backpack::crud.file_manager')); ?>

      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url(config('backpack.base.route_prefix'))); ?>">Admin</a></li>
        <li class="active"><?php echo e(trans('backpack::crud.file_manager')); ?></li>
      </ol>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Element where elFinder will be created (REQUIRED) -->
    <div id="elfinder"></div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>