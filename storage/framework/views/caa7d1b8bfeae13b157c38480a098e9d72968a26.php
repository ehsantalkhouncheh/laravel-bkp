<?php $attributes = $attributes->exceptProps([
    'leadingAddOn' => false,
]); ?>
<?php foreach (array_filter(([
    'leadingAddOn' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="flex rounded-md shadow-sm">
    <?php if($leadingAddOn): ?>
        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            <?php echo e($leadingAddOn); ?>

        </span>
    <?php endif; ?>

    <input <?php echo e($attributes->merge(['class' => 'flex-1 form-input border-cool-gray-300 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')])); ?>/>
</div>
<?php /**PATH /var/www/html/resources/views/components/input/text.blade.php ENDPATH**/ ?>