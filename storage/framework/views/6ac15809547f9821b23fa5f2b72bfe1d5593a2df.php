<?php $attributes = $attributes->exceptProps(['type' => 'link']); ?>
<?php foreach (array_filter((['type' => 'link']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if($type === 'link'): ?>
    <a <?php echo e($attributes->merge(['href' => '#', 'class' => 'block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900'])); ?> role="menuitem">
        <?php echo e($slot); ?>

    </a>
<?php elseif($type === 'button'): ?>
    <button <?php echo e($attributes->merge(['type' => 'button', 'class' => 'block w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900'])); ?> role="menuitem">
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/dropdown/item.blade.php ENDPATH**/ ?>