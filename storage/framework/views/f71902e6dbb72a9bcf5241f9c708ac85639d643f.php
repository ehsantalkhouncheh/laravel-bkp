<?php if(!$component): ?>
    <<?php echo e($as ?? 'div'); ?>

        <?php echo e($attributes); ?>

        data-sort-key="<?php echo e($sortKey); ?>"
    >
        <?php echo e($slot); ?>

    </<?php echo e($as ?? 'div'); ?>>
<?php endif; ?>

<?php if($component): ?>
    <?php if (isset($component)) { $__componentOriginal3bf0a20793be3eca9a779778cf74145887b021b9 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\DynamicComponent::class, ['component' => $component]); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['attributes' => $attributes,'data-sort-key' => ''.e($sortKey).'']); ?>
        <?php echo e($slot); ?>

     <?php if (isset($__componentOriginal3bf0a20793be3eca9a779778cf74145887b021b9)): ?>
<?php $component = $__componentOriginal3bf0a20793be3eca9a779778cf74145887b021b9; ?>
<?php unset($__componentOriginal3bf0a20793be3eca9a779778cf74145887b021b9); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/vendor/asantibanez/laravel-blade-sortable/src/../resources/views/components/sortable-item.blade.php ENDPATH**/ ?>