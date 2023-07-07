<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'title' => '',
    'active' => false
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'title' => '',
    'active' => false
]); ?>
<?php foreach (array_filter(([
    'title' => '',
    'active' => false
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php

$classes = 'transition-colors hover:text-gray-900 dark:hover:text-gray-100';

$active
    ? $classes .= ' text-gray-900 dark:text-gray-200'
    : $classes .= ' text-gray-500 dark:text-gray-400';

?>

<li class="relative leading-8 m-0 pl-6 last:before:bg-white last:before:h-auto last:before:top-4 last:before:bottom-0 dark:last:before:bg-dark-eval-1 before:block before:w-4 before:h-0 before:absolute before:left-0 before:top-4 before:border-t-2 before:border-t-gray-200 before:-mt-0.5 dark:before:border-t-gray-600">
    <a <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php echo e($title); ?>

    </a>
</li>
<?php /**PATH C:\Naufal Nafidiin\Koding\breeze\resources\views/components/sidebar/sublink.blade.php ENDPATH**/ ?>