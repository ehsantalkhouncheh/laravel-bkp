<?php if($name): ?>
    <template x-for="value in sortOrder" x-key="index">
        <input
            type="hidden"
            name="<?php echo e($name); ?>[]"
            x-model:value="value"
        />
    </template>
<?php endif; ?>
<?php /**PATH /var/www/html/vendor/asantibanez/laravel-blade-sortable/src/../resources/views/includes/hidden-inputs.blade.php ENDPATH**/ ?>