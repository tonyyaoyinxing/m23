<template>
  <div class='yourDiv'>
    <vdr
    :active="isActive"
    :x="100"
    :y="100"
    :w="200"
    :h="200"
    :r="0"
    @activated="activated"

    @dragStart="dragStart"
    @resizeStart="resizeStart"
    @rotateStart="rotateStart"

    @dragging="dragging"
    @resizing="resizing"
    @rotating="rotating"

    @dragStop="dragStop"
    @resizeStop="resizeStop"
    @rotateStop="rotateStop"
    ></vdr>
  </div>
</template>
<script>
    define(['Vue'], function(Vue) {
        // eslint-disable-next-line vue/component-definition-name-casing
        Vue.component('block-image', {
            data(){
                return{
                isActive:true
                }
            },
            methods:{
                activated(pos) {
                this.isActive = true;
                console.log('选中当前元素',pos)
                },

                dragStart(pos){
                console.log('拖拽开始',pos)
                },
                resizeStart(pos){
                console.log('缩放开始',pos)
                },
                rotateStart(pos){
                console.log('旋转开始',pos)
                },

                dragging(pos) {
                console.log('拖拽中'，pos)
                },
                resizing(pos) {
                console.log('缩放中'，pos)
                },
                rotating(pos) {
                console.log('旋转中'，pos)
                },

                dragStop(pos){
                console.log('拖拽停止',pos)
                },
                resizeStop(pos){
                console.log('缩放停止',pos)
                },
                rotateStop(pos){
                console.log('旋转停止',pos)
                },
            }
        });
    });
</script>