<span class="inline-flex rounded-md shadow-sm">
    <button
        <?php echo e($attributes->merge([
            'type' => 'button',
            'class' => 'py-2 px-4 border rounded-md text-sm leading-5 font-medium focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
        ])); ?>

    >
        <?php echo e($slot); ?>

    </button>
</span>
<?php /**PATH /var/www/html/resources/views/components/button.blade.php ENDPATH**/ ?>