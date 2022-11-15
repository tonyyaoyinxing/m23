<template>
  <a class="c-button" :style="{fontWeight:rect.fontWeight,fontStyle:rect.fontStyle,color:rect.fontColor,fontSize:rect.fontSize,lineHeight:rect.height+'px',border:'1px solid '+rect.fontColor}">{{rect.headline?rect.headline:rect.name}}</a>
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
