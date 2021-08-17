<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Layout')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.layout-management', [])->html();
} elseif ($_instance->childHasBeenRendered('zqhwvIP')) {
    $componentId = $_instance->getRenderedChildComponentId('zqhwvIP');
    $componentTag = $_instance->getRenderedChildComponentTagName('zqhwvIP');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('zqhwvIP');
} else {
    $response = \Livewire\Livewire::mount('admin.layout-management', []);
    $html = $response->html();
    $_instance->logRenderedChild('zqhwvIP', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php if (isset($component)) { $__componentOriginalac8b928e8dab28132db70043bc18ea829dd355a6 = $component; } ?>
<?php $component = $__env->getContainer()->make(Asantibanez\LaravelBladeSortable\Components\Sortable::class, []); ?>
<?php $component->withName('laravel-blade-sortable::sortable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
            <?php if (isset($component)) { $__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498 = $component; } ?>
<?php $component = $__env->getContainer()->make(Asantibanez\LaravelBladeSortable\Components\SortableItem::class, ['sortKey' => 'jason']); ?>
<?php $component->withName('laravel-blade-sortable::sortable-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                Jason
             <?php if (isset($__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498)): ?>
<?php $component = $__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498; ?>
<?php unset($__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498 = $component; } ?>
<?php $component = $__env->getContainer()->make(Asantibanez\LaravelBladeSortable\Components\SortableItem::class, ['sortKey' => 'andres']); ?>
<?php $component->withName('laravel-blade-sortable::sortable-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                Andres
             <?php if (isset($__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498)): ?>
<?php $component = $__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498; ?>
<?php unset($__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498 = $component; } ?>
<?php $component = $__env->getContainer()->make(Asantibanez\LaravelBladeSortable\Components\SortableItem::class, ['sortKey' => 'matt']); ?>
<?php $component->withName('laravel-blade-sortable::sortable-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                Matt
             <?php if (isset($__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498)): ?>
<?php $component = $__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498; ?>
<?php unset($__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498 = $component; } ?>
<?php $component = $__env->getContainer()->make(Asantibanez\LaravelBladeSortable\Components\SortableItem::class, ['sortKey' => 'james']); ?>
<?php $component->withName('laravel-blade-sortable::sortable-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                James
             <?php if (isset($__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498)): ?>
<?php $component = $__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498; ?>
<?php unset($__componentOriginalffbc7b63e343527e73fe1e4efeafb61745ccb498); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
         <?php if (isset($__componentOriginalac8b928e8dab28132db70043bc18ea829dd355a6)): ?>
<?php $component = $__componentOriginalac8b928e8dab28132db70043bc18ea829dd355a6; ?>
<?php unset($__componentOriginalac8b928e8dab28132db70043bc18ea829dd355a6); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views//admin/layouts.blade.php ENDPATH**/ ?>