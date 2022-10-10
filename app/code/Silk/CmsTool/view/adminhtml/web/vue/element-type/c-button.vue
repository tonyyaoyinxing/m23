<template>
  <button class="my-button"
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
    define(['Vue'], function(Vue) {
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
                    this.elements.push({
                        width: 100,
                        height: 100,
                        left: 10,
                        top: 10,
                        isActive: true
                    });
                },
            },
            template: template
        });
    });
</script>