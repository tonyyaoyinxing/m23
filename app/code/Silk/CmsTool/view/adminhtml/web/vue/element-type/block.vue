<template>
  
</template>
<script>
    define(['Vue'], function(Vue) {
        // eslint-disable-next-line vue/component-definition-name-casing
        Vue.component('block', {
            name: 'block',
            emits: ['clicked', 'dragging', 'dragstop', 'resizing', 'resizestop', 'activated', 'deactivated'],
            template: template
        });
    });
</script>