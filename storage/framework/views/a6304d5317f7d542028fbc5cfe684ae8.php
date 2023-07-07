<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['as' => 'div']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['as' => 'div']); ?>
<?php foreach (array_filter((['as' => 'div']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<!-- The most horrobile way -->
<<?php echo e($as); ?>

    x-data="perfectScroll"
    <?php echo e($attributes->merge(['class' => 'relative max-h-full'])); ?>

    x-on:mousemove="update"
>
    <?php echo e($slot); ?>

</<?php echo e($as); ?>>

<script>
    const perfectScroll = () => {
        let ps

        const update = () => {
            if (ps) {
                ps.update()
            }
        }

        return {
            init(){
                ps = new PerfectScrollbar(this.$el, {
                    wheelSpeed: 2,
                    wheelPropagation: false,
                    minScrollbarLength: 20
                });
            },
            update
        }
    }
</script>
<?php /**PATH C:\Naufal Nafidiin\Koding\breeze\resources\views/components/perfect-scrollbar.blade.php ENDPATH**/ ?>