<template>
    <a href="#">
        <div class="{rect.buttonStyle}" >{{rect.name}}</div>
        <div class="{rect.buttonStyle}" >¥{{rect.price}}</div>
    </a>
</template>
<script>
define([
    'Vue',
    'jquery'
], function(Vue,$) {
    Vue.component('c-link', {
        name: 'c-link',
        data() {
            return {}
        },
        props: {
            rect: {
                type: Object,
                required:true,
            },
        },
        methods: {
            
        },
        template: template
    });
});
</script>
  