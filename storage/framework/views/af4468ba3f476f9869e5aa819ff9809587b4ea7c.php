<button
    <?php echo e($attributes->merge([
        'type' => 'button',
        'class' => 'text-cool-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-cool-gray-800 focus:underline transition duration-150 ease-in-out' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
    ])); ?>

>
    <?php echo e($slot); ?>

</button>
<?php /**PATH /var/www/html/resources/views/components/button/link.blade.php ENDPATH**/ ?>