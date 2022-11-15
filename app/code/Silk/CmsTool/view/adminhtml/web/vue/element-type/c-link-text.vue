<template>
    <a><div class="c-link-text" :style="{fontWeight:rect.fontWeight,fontStyle:rect.fontStyle,color:rect.fontColor,fontSize:rect.fontSize,textAlign:'center',lineHeight:rect.height+'px'}" >{{rect.headline?rect.headline:rect.name}}</div></a>
</template>
<script>
define([
    'Vue',
    'jquery'
], function(Vue,$) {
    Vue.component('c-link-text', {
        name: 'c-link-text',
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
  