<template>
  <button 
    class="{rect.buttonStyle}"
  >
    <slot>{{rect.headline}}</slot>
  </button>
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
