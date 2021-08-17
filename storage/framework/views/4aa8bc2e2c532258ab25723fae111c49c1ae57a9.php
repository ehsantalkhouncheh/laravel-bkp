<?php $attributes = $attributes->exceptProps([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
    'inline' => false,
    'paddingless' => false,
    'borderless' => false,
]); ?>
<?php foreach (array_filter(([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
    'inline' => false,
    'paddingless' => false,
    'borderless' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if($inline): ?>
    <div>
        <label for="<?php echo e($for); ?>" class="block text-sm font-medium leading-5 text-gray-700"><?php echo e($label); ?></label>

        <div class="mt-1 relative rounded-md shadow-sm">
            <?php echo e($slot); ?>


            <?php if($error): ?>
                <div class="mt-1 text-red-500 text-sm"><?php echo e($error); ?></div>
            <?php endif; ?>

            <?php if($helpText): ?>
                <p class="mt-2 text-sm text-gray-500"><?php echo e($helpText); ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start <?php echo e($borderless ? '' : ' sm:border-t '); ?> sm:border-gray-200 <?php echo e($paddingless ? '' : ' sm:py-5 '); ?>">
        <label for="<?php echo e($for); ?>" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
            <?php echo e($label); ?>

        </label>

        <div class="mt-1 sm:mt-0 sm:col-span-2">
            <?php echo e($slot); ?>


            <?php if($error): ?>
                <div class="mt-1 text-red-500 text-sm"><?php echo e($error); ?></div>
            <?php endif; ?>

            <?php if($helpText): ?>
                <p class="mt-2 text-sm text-gray-500"><?php echo e($helpText); ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/input/group.blade.php ENDPATH**/ ?>