
<td data-order="<?php echo e($entry->{$column['name']}); ?>">
	<?php if($entry->{$column['name']} === true || $entry->{$column['name']} === 1 || $entry->{$column['name']} === '1'): ?>
        <?php if( isset( $column['options'][1] ) ): ?>
            <?php echo e($column['options'][1]); ?>

        <?php else: ?>
            <?php echo e(Lang::has('backpack::crud.yes')?trans('backpack::crud.yes'):'Yes'); ?>

        <?php endif; ?>
    <?php else: ?>
        <?php if( isset( $column['options'][0] ) ): ?>
            <?php echo e($column['options'][0]); ?>

        <?php else: ?>
            <?php echo e(Lang::has('backpack::crud.no')?trans('backpack::crud.no'):'No'); ?>

        <?php endif; ?>
    <?php endif; ?>
</td>
