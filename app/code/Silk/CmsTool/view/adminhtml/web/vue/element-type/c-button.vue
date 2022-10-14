<template>
  <button class="my-button" id="popup-modal"
    :disabled="disabled"
    :class="{
      [`my-button-${type}`]: true,
      [`my-button-${type}-disabled`]: disabled,
    }"
    @click="handleClick()"
  >
    <slot>{{title}}</slot>
  </button>
</template>
<script>
    define([
        'Vue',
        'jquery',
        'Magento_Ui/js/modal/modal'
      ], function(Vue,$,modal) {
        // eslint-disable-next-line vue/component-definition-name-casing
        
        Vue.component('c-button', {
            name: 'c-button',
            data() {
                return {}
            },
            props: {
                type: {
                    validator(value) {
                      return 'primary'
                    },
                    type: String,
                    default: 'primary',
                },
                disabled: {
                  type: Boolean,
                  default: false,
                },
                title:{
                  type: String,
                  required:true,
                },
                elements: {
                    type: Array,
                    required: true
                },
            },
            methods: {
                handleClick() {
                    switch(this.title){
                        case "text":
                            $('#popup-modal').modal('openModal');
                            break
                        case "image":
                            //这里是值对应的处理
                            break
                        case "background":
                            //这里是值对应的处理
                            break
                        default:
                            //这里是没有找到对应的值处理
                            break
                    }
                    // this.elements.push({
                    //     width: 100,
                    //     height: 100,
                    //     left: 10,
                    //     top: 10,
                    //     isActive: true
                    // });
                },
            },
            template: template
        });
    });
</script>
