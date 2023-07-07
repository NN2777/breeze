<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'disabled' => false,
    'withicon' => false
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'disabled' => false,
    'withicon' => false
]); ?>
<?php foreach (array_filter(([
    'disabled' => false,
    'withicon' => false
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $withiconClasses = $withicon ? 'pl-11 pr-4' : 'px-4'
?>

<input
    <?php echo e($disabled ? 'disabled' : ''); ?>

    <?php echo $attributes->merge([
            'class' => $withiconClasses . ' py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
            focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1',
        ]); ?>

>
<?php /**PATH C:\Naufal Nafidiin\Koding\breeze\resources\views/components/form/input.blade.php ENDPATH**/ ?>