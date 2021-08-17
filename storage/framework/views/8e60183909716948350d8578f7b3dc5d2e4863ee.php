<div class="flex items-center">
    <?php echo e($slot); ?>


    <div x-data="{ focused: false }">
        <span class="ml-5 rounded-md shadow-sm">
            <input @focus="focused = true" @blur="focused = false" class="sr-only" type="file" <?php echo e($attributes); ?>>
            <label for="<?php echo e($attributes['id']); ?>" :class="{ 'outline-none border-blue-300 shadow-outline-blue': focused }" class="cursor-pointer py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                Select File
            </label>
        </span>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/input/file-upload.blade.php ENDPATH**/ ?>