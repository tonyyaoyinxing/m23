<template>
  <a class="c-button" :class="rect.buttonStyle" href="">{{rect.headline?rect.headline:rect.name}}</a>
</template>
<script>
define([
    'Vue',
    'jquery'
  ], function(Vue,$) {
    Vue.component('c-button', {
        name: 'c-button',
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
