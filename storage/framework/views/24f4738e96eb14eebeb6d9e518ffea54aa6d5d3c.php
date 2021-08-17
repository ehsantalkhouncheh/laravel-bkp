<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('User')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.user-management', [])->html();
} elseif ($_instance->childHasBeenRendered('LcAdBJB')) {
    $componentId = $_instance->getRenderedChildComponentId('LcAdBJB');
    $componentTag = $_instance->getRenderedChildComponentTagName('LcAdBJB');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('LcAdBJB');
} else {
    $response = \Livewire\Livewire::mount('admin.user-management', []);
    $html = $response->html();
    $_instance->logRenderedChild('LcAdBJB', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/users.blade.php ENDPATH**/ ?>